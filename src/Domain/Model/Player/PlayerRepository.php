<?php
declare(strict_types=1);

namespace App\Domain\Model\Player;

interface PlayerRepository
{
    public function findByPlayerNumber(int $playerNumber): ?Player;

    public function findByAverage(string $average): ?Player;

    public function findAll(): array;

    public function save(Player $player): void;
}