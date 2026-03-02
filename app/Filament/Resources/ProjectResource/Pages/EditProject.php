<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;

class EditProject extends BaseEditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

}

