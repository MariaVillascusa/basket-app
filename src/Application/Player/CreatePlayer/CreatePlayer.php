<?php
declare(strict_types=1);

namespace App\Application\CreatePlayer;

final class CreatePlayer
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