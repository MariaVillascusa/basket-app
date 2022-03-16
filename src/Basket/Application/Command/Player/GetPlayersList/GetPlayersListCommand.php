<?php

namespace App\Basket\Application\Command\Player\GetPlayersList;

use App\System\Command;

class GetPlayersListCommand extends Command
{
    protected const VERSION = 1;
    protected const MODEL = 'player';
    protected const NAME = 'list';

    public static function create()
    {
        return new GetPlayersListCommand();
    }
}