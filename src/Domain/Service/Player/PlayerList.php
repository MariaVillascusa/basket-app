<?php

namespace App\Domain\Service\Player;

use App\Infrastructure\Files\PlayerRepository;

class PlayerList
{
    private PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function execute(): array
    {
        $players = $this->playerRepository->findAll();

        if ($players === null) {
            throw new \Error('No hay ningún jugador registrado');
        }
        return $players;
    }
}