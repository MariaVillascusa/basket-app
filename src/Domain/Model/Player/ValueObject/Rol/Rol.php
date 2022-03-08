<?php

namespace App\Domain\Model\Player\ValueObject\Rol;

enum Rol: string
{
case base = 'BASE';
case escolta = 'ESCOLTA';
case alero = 'ALERO';
case ala_pivot = 'ALA-PIVOT';
case pivot = 'PIVOT';
}

