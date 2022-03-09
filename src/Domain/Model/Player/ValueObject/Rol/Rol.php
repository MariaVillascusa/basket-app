<?php

namespace App\Domain\Model\Player\ValueObject\Rol;

enum Rol: string
{
    case base = 'BASE';
    case escolta = 'ESCOLTA';
    case alero = 'ALERO';
    case ala_pivot = 'ALA-PIVOT';
    case pivot = 'PIVOT';

    public static function getRolName($value): ?Rol
    {
        return match ($value){
            'BASE' => self::base,
            'ESCOLTA' => self::base,
            'ALERO' => self::base,
            'ALA-PIVOT' => self::base,
            'PIVOT' => self::base,
            default => null
        };
    }
}

