<?php

namespace App\Filament\Resources;

use App\Actions\PromoteProspectToClientAction;
use App\Enums\ProspectStatus;
use App\Filament\Resources\ProspectResource\Pages;
use App\Models\Prospect;
use BackedEnum;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
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
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('source')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('source_external_id')
                            ->label('Source External ID')
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->options(collect(ProspectStatus::cases())->mapWithKeys(
                                fn (ProspectStatus $status) => [$status->value => $status->getLabel()]
                            ))
                            ->required(),
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
                Section::make('Raw Payload')
                    ->schema([
                        Forms\Components\Textarea::make('raw_payload')
                            ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_PRETTY_PRINT) : null)
                            ->disabled()
                            ->rows(8)
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
            ->actions([
                \Filament\Actions\Action::make('promote')
                    ->label('Promote to Client')
                    ->icon('heroicon-o-arrow-up-circle')
                    ->visible(fn (Prospect $record) => $record->client_id === null)
                    ->requiresConfirmation()
                    ->action(function (Prospect $record, PromoteProspectToClientAction $promoteProspect) {
                        $client = $promoteProspect($record);

                        Notification::make()
                            ->title("Promoted to client: {$client->name}")
                            ->success()
                            ->send();
                    }),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListProspects::route('/'),
            'create' => Pages\CreateProspect::route('/create'),
            'edit' => Pages\EditProspect::route('/{record}/edit'),
        ];
    }
}
