<?php

namespace App\Filament\Resources;

use App\Actions\PromoteProspectToClientAction;
use App\Enums\ProspectStatus;
use App\Filament\Resources\ProspectResource\Pages;
use App\Models\Prospect;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
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
use UnitEnum;

class ProspectResource extends Resource
{
    protected static ?string $model = Prospect::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-funnel';

    protected static string | UnitEnum | null $navigationGroup = 'CRM';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('source')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('source_external_id')
                            ->label('Source External ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('company')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('website')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('latitude')
                            ->numeric(),
                        Forms\Components\TextInput::make('longitude')
                            ->numeric(),
                        Forms\Components\Textarea::make('summary')
                            ->rows(4)
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
            ->components([
                Section::make('Prospect')
                    ->afterHeader([
                        static::editDetailsAction(),
                    ])
                    ->schema([
                        TextEntry::make('source')
                            ->badge(),
                        TextEntry::make('source_external_id')
                            ->label('Source External ID')
                            ->placeholder('—'),
                        TextEntry::make('name')
                            ->placeholder('—'),
                        TextEntry::make('company')
                            ->placeholder('—'),
                        TextEntry::make('email')
                            ->placeholder('—')
                            ->copyable(),
                        TextEntry::make('phone')
                            ->placeholder('—')
                            ->copyable(),
                        TextEntry::make('website')
                            ->placeholder('—')
                            ->url(fn (?string $state): ?string => $state, true),
                        TextEntry::make('location')
                            ->label('Location')
                            ->state(fn (Prospect $record): ?string => $record->latitude !== null && $record->longitude !== null
                                ? "{$record->latitude}, {$record->longitude}"
                                : null)
                            ->placeholder('—'),
                        TextEntry::make('summary')
                            ->placeholder('—')
                            ->columnSpanFull(),
                        TextEntry::make('created_at')
                            ->dateTime(),
                    ])
                    ->columns(2),
                Section::make('Status')
                    ->afterHeader([
                        Action::make('promote')
                            ->label('Promote to Client')
                            ->icon(Heroicon::ArrowUpCircle)
                            ->color('success')
                            ->visible(fn (Prospect $record): bool => $record->client_id === null)
                            ->requiresConfirmation()
                            ->action(function (Prospect $record, PromoteProspectToClientAction $promoteProspect): void {
                                $client = $promoteProspect($record);

                                Notification::make()
                                    ->title("Promoted to client: {$client->name}")
                                    ->success()
                                    ->send();
                            }),
                        ActionGroup::make(
                            collect(ProspectStatus::cases())
                                ->reject(fn (ProspectStatus $status) => $status === ProspectStatus::Converted)
                                ->map(fn (ProspectStatus $status) => Action::make("markStatus{$status->value}")
                                    ->label($status->getLabel())
                                    ->color($status->getColor())
                                    ->action(fn (Prospect $record) => $record->markStatus($status)))
                                ->all()
                        )
                            ->label('Set Status')
                            ->icon(Heroicon::ChevronDown)
                            ->button(),
                    ])
                    ->schema([
                        TextEntry::make('status')
                            ->badge(),
                        TextEntry::make('client.name')
                            ->label('Client')
                            ->placeholder('Not promoted yet')
                            ->url(fn (Prospect $record): ?string => $record->client_id
                                ? ClientResource::getUrl('edit', ['record' => $record->client_id])
                                : null),
                    ])
                    ->columns(2),
                Section::make('Raw Payload')
                    ->schema([
                        TextEntry::make('raw_payload')
                            ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_PRETTY_PRINT) : null)
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('source')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->copyable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(collect(ProspectStatus::cases())->mapWithKeys(
                        fn (ProspectStatus $status) => [$status->value => $status->getLabel()]
                    )),
                Tables\Filters\SelectFilter::make('source')
                    ->options(fn () => Prospect::query()->distinct()->pluck('source', 'source')),
            ])
            ->recordActions([
                ViewAction::make()
                    ->modalCancelActionLabel('Close')
                    ->slideOver(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    protected static function editDetailsAction(): Action
    {
        return Action::make('editDetails')
            ->label('Edit Details')
            ->icon(Heroicon::PencilSquare)
            ->color('gray')
            ->outlined()
            ->schema([
                Forms\Components\TextInput::make('name')->maxLength(255),
                Forms\Components\TextInput::make('company')->maxLength(255),
                Forms\Components\TextInput::make('email')->email()->maxLength(255),
                Forms\Components\TextInput::make('phone')->tel()->maxLength(255),
                Forms\Components\TextInput::make('website')->url()->maxLength(255),
                Forms\Components\TextInput::make('latitude')->numeric(),
                Forms\Components\TextInput::make('longitude')->numeric(),
                Forms\Components\Textarea::make('summary')->rows(4)->columnSpanFull(),
            ])
            ->fillForm(fn (Prospect $record): array => $record->only([
                'name', 'company', 'email', 'phone', 'website', 'latitude', 'longitude', 'summary',
            ]))
            ->action(function (array $data, Prospect $record): void {
                $record->update($data);
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
            'index' => Pages\ManageProspects::route('/'),
        ];
    }
}
