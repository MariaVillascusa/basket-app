<?php
declare(strict_types=1);

namespace App\System;

abstract class Command
{
    public function messageName(): string
    {
        return $this::COMPANY . $this::PROJECT . $this::VERSION . $this::TYPE . $this::MODEL . $this::NAME;

    }
}