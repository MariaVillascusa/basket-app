<?php

namespace App\Basket\Domain\Model\Player\ValueObject\Role;

use App\Basket\Domain\Model\Player\Exceptions\RoleNotValidException;

enum Role: string
{
    case base = 'BASE';
    case escolta = 'ESCOLTA';
    case alero = 'ALERO';
    case ala_pivot = 'ALA-PIVOT';
    case pivot = 'PIVOT';

    public static function tryGetFrom(int|string $role): ?static
    {
        $role = role::tryFrom(strtoupper($role));
        if ($role === null) {
            throw new RoleNotValidException();
        }
        return $role;
    }
}
