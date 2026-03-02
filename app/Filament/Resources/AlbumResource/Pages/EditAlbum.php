<?php

namespace App\Filament\Resources\AlbumResource\Pages;

use App\Filament\Resources\AlbumResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;

class EditAlbum extends BaseEditRecord
{
    protected static string $resource = AlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

}

