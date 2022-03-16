<?php
declare(strict_types=1);

namespace App\Basket\Infrastructure\Files;

use App\Basket\Domain\Model\Player\Player;
use App\Domain\Model\Player\ValueObject\Rol\Rol;
use Exception;
use PhpParser\Error;


final class PlayerRepository implements \App\Basket\Domain\Model\Player\PlayerRepository
{
    private array $players = [];
    private string $path;


    public function __construct(string $path = '/players.csv')
    {
        $this->path = $path;

        if (file_exists(__DIR__ . $this->path) === false) {
            throw new Error('File not found');
        }
        $file = fopen(__DIR__ . $this->path, 'rb');

        while (($data = fgetcsv($file, 1000, ',')) !== false) {

            $player = $this->hydrate($data);
            $this->players[$player->playerNumber()] = $player;
        }
        fclose($file);
    }

    public function save(Player $player): void
    {
        $file = fopen(__DIR__ . $this->path, 'ab');

        fputcsv($file, [
            $player->playerNumber(),
            $player->name(),
            $player->role()->value,
            $player->average()->value()
        ]);
        fclose($file);

        $this->players[] = $player;
    }

    public function delete(int $playerNumber): void
    {
        $readFile = file(__DIR__ . $this->path);
        $out = [];
        foreach ($readFile as $linea) {
            $playerLine = explode(',', $linea);

            if ((int)$playerLine[0] !== $playerNumber) {
                $out[] = substr($linea, 0, -1);
            }
        }
        $file = fopen(__DIR__ . $this->path, 'wb');
        foreach ($out as $linea) {
            fputcsv($file, explode(',', $linea));
        }
        fclose($file);

        $index = array_search($this->findByPlayerNumber($playerNumber), $this->players, true);
        unset($this->players[$index]);
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
        return $this->players;
    }
}