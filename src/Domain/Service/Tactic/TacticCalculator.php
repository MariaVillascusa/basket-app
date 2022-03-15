<?php

namespace App\Domain\Service;

use App\Domain\Model\Player\PlayerRepository;
use App\Domain\Model\Tactic;
use App\Domain\Service\Player\PlayerOrder;

class TacticCalculator
{
    private PlayerRepository $playerRepository;
    private PlayerOrder $playerOrder;

    public function __construct(PlayerRepository $playerRepository, PlayerOrder $playerOrder)
    {
        $this->playerRepository = $playerRepository;
        $this->playerOrder = $playerOrder;
    }

    public function execute(string $selectedTactic): array
    {
        $players = $this->getOrderedPlayersByAverage();

        $tactic = $this->getTactic($selectedTactic);

        return $this->getLineUpPlayers($tactic, $players);
    }

    private function getOrderedPlayersByAverage(): array
    {
        $players = $this->playerRepository->findAll();

        return $this->playerOrder->order($players, 'media');
    }

    private function getTactic(string $tacticResponse): array
    {
        return match ($tacticResponse) {
            'Defensa' => Tactic::DEFENSE,
            'Defensa zonal' => Tactic::ZONE_DEFENSE,
            'Ataque' => Tactic::ATTACK
        };
//TO-DO
    }

    private function getLineUpPlayers(array $tactic, array $players): array
    {
        $orderedPlayersPerPosition = [];
        $lineupPlayers = [];

        for ($i = 0; $i <= count($tactic) - 1; $i++) {
            foreach ($players as $player) {
                if ($player->role()->value === $tactic[$i]) {
                    $orderedPlayersPerPosition[] = $player;
                }
            }
        }
        for ($i = 0; $i < count($tactic) - 1; $i++) {
            foreach ($orderedPlayersPerPosition as $player) {
                if ($player->role()->value === $tactic[$i]) {

                    $lineupPlayers[] = $player;
                    $i++;
                }
                if (count($lineupPlayers) === 5) {
                    return $lineupPlayers;
                }
            }
        }
        if (count($lineupPlayers) < 5){
            throw new \Error('No tienes suficientes jugadores para esta táctica');
        }
        return $lineupPlayers;
    }
}