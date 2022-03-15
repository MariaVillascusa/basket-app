<?php

namespace App\Basket\Application\Command\Player\GetPlayersList;

use App\Basket\Domain\Service\Player\PlayerList;
use App\Basket\Domain\Service\Player\PlayerOrder;

class GetPlayersListHandler
{
    private PlayerList $list;
    private PlayerOrder $playerOrder;

    public function __construct(PlayerList $list, PlayerOrder $playerOrder)
    {
        $this->list = $list;
        $this->playerOrder = $playerOrder;
    }

    public function __invoke(GetPlayersListCommand $command, null|string $filter): array
    {
        $players = $this->list->execute();

        return $this->playerOrder->order($players, $filter);
    }
}