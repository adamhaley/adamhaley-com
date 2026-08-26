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
    case Viewed = 'viewed';
    case Contacted = 'contacted';
    case Qualified = 'qualified';
    case Converted = 'converted';
    case Disqualified = 'disqualified';

    public function getColor(): string
    {
        return match ($this) {
            self::New => 'gray',
            self::Viewed => 'info',
            self::Contacted => 'primary',
            self::Qualified => 'warning',
            self::Converted => 'success',
            self::Disqualified => 'danger',
        };
    }
}
