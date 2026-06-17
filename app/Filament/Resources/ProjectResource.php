<?php

namespace App\Filament\Resources;

use BackedEnum;
use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Models\ProjectCategory;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
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
