<?php
declare(strict_types=1);

namespace App\Infrastructure\Files;

use App\Domain\Model\Player\Player;
use App\Domain\Model\Player\ValueObject\Rol\Rol;
use App\Domain\Model\Player\ValueObject\Role\Role;
use Exception;
use PhpParser\Error;


final class PlayerRepository implements \App\Domain\Model\Player\PlayerRepository
{
    private array $players = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (file_exists(__DIR__ . '/players.csv') === false) {
            throw new Error('File not found');
        }
        $file = fopen(__DIR__ . '/players.csv', "r");

        while (($data = fgetcsv($file, 1000, ',')) !== false) {

            $player = $this->hydrate($data);
            $this->players[$player->playerNumber()] = $player;
        }
        fclose($file);
    }

    public function save(Player $player): void
    {
        $file = fopen(__DIR__ . '/players.csv', "a");

        fputcsv($file, [
            $player->playerNumber(),
            $player->name(),
            $player->role()->value,
            $player->average()
        ]);
        fclose($file);
    }

    public function delete(Player $player): void
    {
        $readFile = file(__DIR__ . '/players.csv');
        $out = [];
        foreach ($readFile as $linea) {
            if (substr($linea, 0, 1) != $player->playerNumber()) {
                $out[] = substr($linea, 0, -1);
            }
        }

        $file = fopen(__DIR__ . '/players.csv', "w");
        foreach ($out as $linea) {
            fputcsv($file, explode(',', $linea));
        }
        fclose($file);
    }

    private function hydrate($data): Player
    {
        return Player::create(
            (int)$data[0],
            $data[1],
            $data[2],
            (int)$data[3]
        );
    }

    public function findByPlayerNumber(int $playerNumber): ?Player
    {
        foreach ($this->players as $player) {
            if ($player->playerNumber() === $playerNumber) {
                return $player;
            }
        }
        return null;
    }

    public function findByAverage(string $average): ?Player
    {
        foreach ($this->players as $player) {
            if ($player->average() === $average) {
                return $player;
            }
        }
        return null;
    }

    public function findAll(): array
    {
        return [];
    }
}