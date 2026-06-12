<?php

namespace App\Filament\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;

class BaseCreateRecord extends CreateRecord
{
    protected Width | string | null $maxContentWidth = Width::Full;

    public function defaultForm(Schema $schema): Schema
    {
        $schema->columns(1);

        return parent::defaultForm($schema);
    }
}
