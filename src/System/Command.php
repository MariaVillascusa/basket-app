<?php
declare(strict_types=1);

namespace App\System;

abstract class Command
{
    protected const COMPANY = 'fpdual';
    protected const PROJECT = 'basket';
    protected const TYPE = 'command';

    public static function messageName(): string
    {
        return self::COMPANY .'.'. self::PROJECT .'.'. static::VERSION .'.'. self::TYPE .'.'. static::MODEL .'.'. static::NAME;

    }
}