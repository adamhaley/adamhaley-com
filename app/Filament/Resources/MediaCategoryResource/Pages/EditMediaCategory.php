<?php

namespace App\Filament\Resources\MediaCategoryResource\Pages;

use App\Filament\Resources\MediaCategoryResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Pages\Actions;

class EditMediaCategory extends BaseEditRecord
{
    protected static string $resource = MediaCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

}

