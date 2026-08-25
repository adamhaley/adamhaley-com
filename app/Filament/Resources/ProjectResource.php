<?php

namespace App\Filament\Resources;

use BackedEnum;
use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Infolists\Components\ImageEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';

    protected static string | UnitEnum | null $navigationGroup = 'Projects';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->options(ProjectCategory::pluck('name', 'id'))
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('projects')
                            ->visibility('public')
                            ->required()
                            ->columnSpanFull(),
                        Actions::make([
                            static::manageImagesAction(),
                        ])
                            ->visible(fn (?Project $record): bool => $record !== null)
                            ->columnSpanFull(),
                        ImageEntry::make('images.path')
                            ->label('Gallery')
                            ->disk('public')
                            ->size(60)
                            ->stacked()
                            ->limit(5)
                            ->visible(fn (?Project $record): bool => $record !== null && $record->images->isNotEmpty())
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('link')
                            ->url()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('github')
                            ->url()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TagsInput::make('tags')
                            ->required()
                            ->separator(',')
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('date')
                            ->required(),
                        Forms\Components\Select::make('clients')
                            ->relationship('clients', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->columnSpanFull(),
                    ])->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->size(50),
                Tables\Columns\ImageColumn::make('images.path')
                    ->label('Gallery')
                    ->disk('public')
                    ->size(50)
                    ->stacked()
                    ->limit(3),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('projectCategory.name')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('clients.name')
                    ->label('Clients')
                    ->badge()
                    ->separator(','),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('link')
                    ->limit(30)
                    ->url(fn ($record) => $record->link, true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->options(ProjectCategory::pluck('name', 'id')),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('date', 'desc');
    }

    public static function manageImagesAction(): Action
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
                            ->directory('projects')
                            ->visibility('public')
                            ->required(),
                    ])
                    ->addActionLabel('Add image')
                    ->reorderable()
                    ->columnSpanFull(),
            ])
            ->fillForm(fn (Project $record): array => [
                'images' => $record->images->map(fn (ProjectImage $image): array => ['path' => $image->path])->all(),
            ])
            ->action(function (array $data, Project $record): void {
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
