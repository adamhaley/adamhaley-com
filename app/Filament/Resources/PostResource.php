<?php

namespace App\Filament\Resources;

use App\Actions\GeneratePostAiDraftAction;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\PostImage;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use RuntimeException;
use UnitEnum;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static string | UnitEnum | null $navigationGroup = 'Content';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Post::class, 'slug', ignoreRecord: true),
                        Forms\Components\TagsInput::make('tags')
                            ->required()
                            ->separator(',')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('raw')
                            ->label('Raw notes')
                            ->rows(8)
                            ->columnSpanFull(),
                    ])->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Post')
                    ->afterHeader([
                        static::editDetailsAction(),
                    ])
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        TextEntry::make('tags')
                            ->badge(),
                        TextEntry::make('created_at')
                            ->dateTime(),
                    ])
                    ->columns(2),
                Section::make('Images')
                    ->afterHeader([
                        static::manageImagesAction(),
                    ])
                    ->schema([
                        TextEntry::make('images_count')
                            ->label('Images')
                            ->state(fn (Post $record): string => (string) $record->images()->count()),
                    ]),
                Section::make('Editing Pipeline')
                    ->afterHeader([
                        static::editRawAction(),
                        static::generateAiDraftAction(),
                        static::copyDraftToFinalAction(),
                    ])
                    ->schema([
                        TextEntry::make('raw')
                            ->label('Raw notes')
                            ->placeholder('No raw notes yet.')
                            ->columnSpanFull(),
                        TextEntry::make('ai_draft')
                            ->label('AI draft')
                            ->html()
                            ->placeholder('No AI draft generated yet.')
                            ->columnSpanFull(),
                        TextEntry::make('ai_draft_generated_at')
                            ->label('Draft generated')
                            ->dateTime()
                            ->placeholder('—'),
                    ])
                    ->columns(1)
                    ->collapsible(),
                Section::make('Final')
                    ->afterHeader([
                        static::editBodyAction(),
                    ])
                    ->schema([
                        TextEntry::make('body')
                            ->label('')
                            ->html()
                            ->placeholder('No final content yet.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->size(50)
                    ->state(fn (Post $record): ?string => $record->images->first()?->path),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ai_draft_generated_at')
                    ->label('Draft generated')
                    ->dateTime()
                    ->placeholder('—')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->modalCancelActionLabel('Close')
                    ->slideOver(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    protected static function editDetailsAction(): Action
    {
        return Action::make('editDetails')
            ->label('Edit Details')
            ->icon(Heroicon::PencilSquare)
            ->color('gray')
            ->outlined()
            ->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Post::class, 'slug', ignoreRecord: true),
                Forms\Components\TagsInput::make('tags')
                    ->required()
                    ->separator(',')
                    ->columnSpanFull(),
            ])
            ->fillForm(fn (Post $record): array => $record->only(['title', 'slug', 'tags']))
            ->action(function (array $data, Post $record): void {
                $record->update($data);
            });
    }

    protected static function editRawAction(): Action
    {
        return Action::make('editRaw')
            ->label('Edit Raw Notes')
            ->icon(Heroicon::DocumentText)
            ->color('gray')
            ->outlined()
            ->schema([
                Forms\Components\Textarea::make('raw')
                    ->label('Raw notes')
                    ->rows(12)
                    ->columnSpanFull(),
            ])
            ->fillForm(fn (Post $record): array => $record->only(['raw']))
            ->action(function (array $data, Post $record): void {
                $record->update($data);
            });
    }

    protected static function generateAiDraftAction(): Action
    {
        return Action::make('generateAiDraft')
            ->label('Generate AI Draft')
            ->icon(Heroicon::Sparkles)
            ->color('primary')
            ->action(function (Post $record, GeneratePostAiDraftAction $generateDraft): void {
                try {
                    $generateDraft($record);
                } catch (RuntimeException $exception) {
                    Notification::make()
                        ->title('Could not generate AI draft')
                        ->body($exception->getMessage())
                        ->danger()
                        ->send();

                    return;
                }

                Notification::make()
                    ->title('AI draft generated')
                    ->success()
                    ->send();
            });
    }

    protected static function copyDraftToFinalAction(): Action
    {
        return Action::make('copyDraftToFinal')
            ->label('Copy Draft to Final')
            ->icon(Heroicon::ArrowRight)
            ->color('gray')
            ->outlined()
            ->visible(fn (Post $record): bool => filled($record->ai_draft))
            ->requiresConfirmation()
            ->modalDescription('This will overwrite the current final content with the AI draft.')
            ->action(function (Post $record): void {
                $record->update(['body' => $record->ai_draft]);

                Notification::make()
                    ->title('AI draft copied to final')
                    ->success()
                    ->send();
            });
    }

    protected static function editBodyAction(): Action
    {
        return Action::make('editBody')
            ->label('Edit Final')
            ->icon(Heroicon::PencilSquare)
            ->color('gray')
            ->outlined()
            ->schema([
                Forms\Components\RichEditor::make('body')
                    ->label('Final content')
                    ->columnSpanFull(),
            ])
            ->fillForm(fn (Post $record): array => $record->only(['body']))
            ->action(function (array $data, Post $record): void {
                $record->update($data);
            });
    }

    protected static function manageImagesAction(): Action
    {
        return Action::make('manageImages')
            ->label('Manage Images')
            ->icon(Heroicon::Photo)
            ->color('gray')
            ->outlined()
            ->schema([
                Forms\Components\Repeater::make('images')
                    ->label('Images')
                    ->schema([
                        Forms\Components\FileUpload::make('path')
                            ->label('Image')
                            ->image()
                            ->disk('public')
                            ->directory('posts')
                            ->visibility('public')
                            ->required(),
                    ])
                    ->addActionLabel('Add image')
                    ->reorderable()
                    ->columnSpanFull(),
            ])
            ->fillForm(fn (Post $record): array => [
                'images' => $record->images->map(fn (PostImage $image): array => ['path' => $image->path])->all(),
            ])
            ->action(function (array $data, Post $record): void {
                $record->images()->delete();

                collect($data['images'] ?? [])->values()->each(
                    fn (array $image, int $index) => $record->images()->create([
                        'path' => $image['path'],
                        'sort_order' => $index,
                    ])
                );

                Notification::make()
                    ->title('Images updated')
                    ->success()
                    ->send();
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePosts::route('/'),
        ];
    }
}
