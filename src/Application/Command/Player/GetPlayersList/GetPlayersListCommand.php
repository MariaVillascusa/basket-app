<?php

namespace App\Application\Command\Player\GetPlayersList;

use App\System\Command;

class GetPlayersListCommand extends Command
{
    protected const TYPE = 1;
    protected const MODEL = 'player';
    protected const NAME = 'list';

    public static function create()
    {
        return new GetPlayersListCommand();
    }
}