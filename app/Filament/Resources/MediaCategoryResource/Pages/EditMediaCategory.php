<?php

namespace App\Filament\Resources\MediaCategoryResource\Pages;

use App\Filament\Resources\MediaCategoryResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;

class EditMediaCategory extends BaseEditRecord
{
    protected static string $resource = MediaCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

}

