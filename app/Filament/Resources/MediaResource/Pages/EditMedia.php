<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Pages\Actions;

class EditMedia extends BaseEditRecord
{
    protected static string $resource = MediaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

