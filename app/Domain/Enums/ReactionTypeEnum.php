<?php

namespace App\Domain\Enums;

enum ReactionTypeEnum : string
{
    case Angery = 'angery';
    case Excitement = 'excitement';
    case Approval = 'approval';
    case Scepticism = 'scepticism';
    case Adoration  = 'adoration';

    case Fear       = 'fear';

    public function is_active(): bool{
        return match ($this) {
            self::Angery => true,
            self::Excitement => true,
            self::Approval => true,
            self::Scepticism => true,
            self::Adoration => true,
            self::Fear => true,
        };
    }
}
