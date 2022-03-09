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

    public function execute(int $playerNumber, string $name, Rol $rol, int $average): Player
    {
        $player = Player::create($playerNumber, $name, $rol, $average);

        $this->playerRepository->save($player);

        return $player;
    }


}