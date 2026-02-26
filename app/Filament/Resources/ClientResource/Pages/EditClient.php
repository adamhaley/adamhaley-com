<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Pages\Actions;

class EditClient extends BaseEditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

}

