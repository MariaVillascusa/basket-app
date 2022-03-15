<?php

namespace App\Application\Command\Tactic\Select;

use App\System\Command;

class SelectTacticCommand extends Command
{
    protected const TYPE = 1;
    protected const MODEL = 'tactic';
    protected const NAME = 'select';

    public static function create()
    {
        return new SelectTacticCommand();
    }
}