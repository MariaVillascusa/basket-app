<?php
declare(strict_types=1);

namespace App\Domain\Service\Player;

use App\Domain\Model\Player\Player;
use App\Domain\Model\Player\PlayerRepository;
use App\Domain\Model\Player\ValueObject\Rol\Rol;

final class PlayerCreator
{
    private PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function execute(int $playerNumber, string $name, string $role, int $average): Player
    {
        $this->verifyIfPlayerExists($playerNumber);

        $player = Player::create($playerNumber, $name, $role, $average);

        $this->playerRepository->save($player);

        return $player;
    }

    /**
     * @param int $playerNumber
     * @return void
     */
    public function verifyIfPlayerExists(int $playerNumber): void
    {
        if ($this->playerRepository->findByPlayerNumber($playerNumber)) {
            throw new \Error('Ya existe un jugador con ese número');
        }
    }
}