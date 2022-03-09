<?php
declare(strict_types=1);

namespace App\Infrastructure\Files;

use App\Domain\Model\Player\Player;
use App\Domain\Model\Player\ValueObject\Rol\Rol;


final class PlayerRepository implements \App\Domain\Model\Player\PlayerRepository
{
    private array $players;

    /**
     * @throws Exception
     */
    public function __construct()
    {

        try {
            $file = fopen(__DIR__ . '/players.csv', "r");

            while (($data = fgetcsv($file, 1000, ',')) !== false) {
                $player = $this->hydrate($data);
                $this->players[$player->playerNumber()] = $player;
            }
            fclose($file);
        } catch (\Exception $e) {
//            echo 'File created\n';
        }
    }

    public function save(Player $player): void
    {
        $file = fopen(__DIR__ . '/players.csv', "a");

        fputcsv($file, [
            $player->playerNumber(),
            $player->name(),
            $player->rol()->value,
            $player->average()
        ]);
        fclose($file);
    }

    private function hydrate($data): Player
    {
        $rol = Rol::getRolName($data[2]);
        return Player::create(
            (int)$data[0],
            $data[1],
            $rol,
            (int)$data[3]
        );
    }

    public function findByPlayerNumber(int $playerNumber): ?Player
    {
        return null;
    }

    public function findByAverage(string $average): ?Player
    {
        return null;
    }

    public function findAll(): array
    {
        return [];
    }
}