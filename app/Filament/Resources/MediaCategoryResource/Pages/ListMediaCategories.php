<?php

namespace App\Filament\Resources\MediaCategoryResource\Pages;

use App\Filament\Resources\MediaCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ListRecords;

class ListMediaCategories extends ListRecords
{
    protected static string $resource = MediaCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

