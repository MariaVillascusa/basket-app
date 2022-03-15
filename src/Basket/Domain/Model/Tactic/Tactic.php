<?php

namespace App\Basket\Domain\Model\Tactic;

class Tactic
{
    public const DEFENSE = [
        'BASE', 'ESCOLTA', 'ESCOLTA', 'ALA-PIVOT', 'PIVOT'
    ];
    public const ZONE_DEFENSE = [
        'BASE', 'BASE', 'ALERO', 'PIVOT', 'ALA-PIVOT'
    ];
    public const ATTACK = [
        'BASE', 'ALERO', 'ESCOLTA', 'PIVOT', 'ALA-PIVOT'
    ];

}