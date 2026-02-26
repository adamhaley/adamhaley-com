<?php

namespace App\Filament\Resources\AlbumResource\Pages;

use App\Filament\Resources\AlbumResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Pages\Actions;

class EditAlbum extends BaseEditRecord
{
    protected static string $resource = AlbumResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

}

