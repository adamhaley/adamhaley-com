<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\TranslatesLabels;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProspectStatus: string implements HasColor, HasLabel
{
    use TranslatesLabels;

    case New = 'new';
    case Contacted = 'contacted';
    case Qualified = 'qualified';
    case Converted = 'converted';
    case Rejected = 'rejected';

    public function getColor(): string
    {
        return match ($this) {
            self::New => 'gray',
            self::Contacted => 'info',
            self::Qualified => 'warning',
            self::Converted => 'success',
            self::Rejected => 'danger',
        };
    }
}
