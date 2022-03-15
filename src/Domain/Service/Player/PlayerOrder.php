<?php

namespace App\Domain\Service\Player;

class PlayerOrder
{
    public function order(array $players, null|string $filter): array
    {
        if ($filter === '') {
            return $players;
        }
        uasort($players, $this->apply($filter));
        return $players;
    }

    private function apply(string $filter): \Closure
    {
        return match ($filter) {
            'dorsal' => static function ($a, $b) {
                if ($a === $b) {
                    return 0;
                }
                return ($a < $b) ? -1 : 1;
            },
            'media' => static function ($a, $b) {
                if ($a->average() === $b->average()) {
                    return 0;
                }
                return ($a->average() > $b->average()) ? -1 : 1;
            },
        };
    }
}