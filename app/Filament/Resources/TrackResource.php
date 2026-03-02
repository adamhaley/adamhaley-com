<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrackResource\Pages;
use App\Models\Album;
use App\Models\Track;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class TrackResource extends Resource
{
    protected static ?string $model = Track::class;

    protected static ?string $navigationIcon = 'heroicon-o-play';

    protected static ?string $navigationGroup = 'Music';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('album_id')
                            ->label('Album')
                            ->options(Album::pluck('name', 'id'))
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->required()
                            ->default(1),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3),
                        Forms\Components\Textarea::make('lyrics')
                            ->required()
                            ->rows(8),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('tracks')
                            ->required(),
                        Forms\Components\FileUpload::make('file')
                            ->directory('tracks/audio')
                            ->required()
                            ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav']),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('album.name')
                    ->label('Album')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('album_id')
                    ->label('Album')
                    ->options(Album::pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('album_id');
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
            'index' => Pages\ListTracks::route('/'),
            'create' => Pages\CreateTrack::route('/create'),
            'edit' => Pages\EditTrack::route('/{record}/edit'),
        ];
    }
}

