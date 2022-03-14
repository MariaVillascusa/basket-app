<?php
declare(strict_types=1);

namespace App\System;

abstract class Command
{
    protected const COMPANY = 'fpdual';
    protected const PROJECT = 'basket';
    protected const VERSION = '1';
    protected const TYPE = 'command';

    public function messageName(): string
    {
        return $this::COMPANY . $this::PROJECT . $this::VERSION . $this::TYPE . $this::MODEL . $this::NAME;

    }
}