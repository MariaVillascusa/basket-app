<?php

namespace App\Application\Command\Player\GetPlayersList;

use App\Domain\Model\Player\Player;
use App\Domain\Service\Player\PlayerList;
use App\Domain\Service\Player\PlayerOrder;

class GetPlayersListHandler
{
    private PlayerList $list;

    public function __construct(PlayerList $list)
    {
        $this->list = $list;
    }

    public function __invoke(GetPlayersListCommand $command, null|string $filter): array
    {
        $players = $this->list->execute();

        return $this->order($players, $filter); // Hacerlo con metodo aparte?
    }

    private function order(array $players, ?string $filter): array
    {
        $ordinator = new PlayerOrder($players);
        return $ordinator->orderBy($filter);
    }
}