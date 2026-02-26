<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;

class EditMedia extends BaseEditRecord
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

