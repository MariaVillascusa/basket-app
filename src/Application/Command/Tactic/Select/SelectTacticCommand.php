<?php

namespace App\Application\Command\Tactic\Select;

use App\System\Command;

class SelectTacticCommand extends Command
{
    protected const TYPE = 1;
    protected const MODEL = 'Tactic';
    protected const NAME = 'select:tactic';

    public static function create()
    {
        return new SelectTacticCommand();
    }
}