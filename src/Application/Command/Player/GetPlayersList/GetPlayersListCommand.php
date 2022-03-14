<?php

namespace App\Application\Command\Player\GetPlayersList;

use App\System\Command;

class GetPlayersListCommand extends Command
{
    protected const MODEL = 'Player';
    protected const NAME = 'list:player';

    public static function create()
    {
        return new GetPlayersListCommand();
    }
}