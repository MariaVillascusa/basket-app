<?php
declare(strict_types=1);

namespace App\Domain\Service\Player;

use App\Domain\Model\Player\Player;
use App\Domain\Model\Player\PlayerRepository;

final class PlayerDestroyer
{
    private PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function execute(int $playerNumber)
    {
        $player = $this->getPlayer($playerNumber);

        $this->playerRepository->delete($player);

        return $player;
    }

    /**
     * @param int $playerNumber
     * @return Player
     */
    public function getPlayer(int $playerNumber): Player
    {
        $player = $this->playerRepository->findByPlayerNumber($playerNumber);
        if (!$player) {
            throw new \Error('No existe un jugador con ese número');
        }
        return $player;
    }
}