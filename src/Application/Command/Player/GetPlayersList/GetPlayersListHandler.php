<?php

namespace App\Application\Command\Player\GetPlayersList;

use App\Domain\Model\Player\Player;
use App\Domain\Service\Player\PlayerList;

class GetPlayersListHandler
{
    private PlayerList $list;

    public function __construct(PlayerList $list)
    {
        $this->list = $list;
    }

    public function __invoke(GetPlayersListCommand $command): array
    {
        return $this->list->execute();
    }

    public function orderBy(array $players, string $filter): array
    {
        if (!$filter) {
            return $players;
        };
        uasort($players, $this->apply($filter));
        return $players;
    }

    private function apply($filter): \Closure
    {
        return match ($filter){
            'dorsal'=> function ($a, $b) {
                if ($a == $b) return 0;
                return ($a < $b) ? -1 : 1;
            },
            'media'=> function ($a, $b) {
                if ($a->average() == $b->average()) return 0;
                return ($a->average() < $b->average()) ? -1 : 1;
            },
        };
    }
}