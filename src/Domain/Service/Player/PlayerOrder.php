<?php

namespace App\Domain\Service\Player;

class PlayerOrder
{
    private array $players;

    public function __construct($players)
    {
        $this->players = $players;
    }

    public function orderBy(null|string $filter): array
    {
        if ($filter == null) {
            return $this->players;
        };
        uasort($this->players, $this->apply($filter));
        return $this->players;
    }

    private function apply(string $filter): \Closure
    {
        return match ($filter) {
            'dorsal' => function ($a, $b) {
                if ($a === $b) return 0;
                return ($a < $b) ? -1 : 1;
            },
            'media' => function ($a, $b) {
                if ($a->average() === $b->average()) return 0;
                return ($a->average() > $b->average()) ? -1 : 1;
            },
        };
    }
}