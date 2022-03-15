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
    }

    private function getLineUpPlayers(array $tactic, array $players): array
    {
        $rolesInTactic = [];

        foreach ($tactic as $role) {
            if (false === array_key_exists($role, $rolesInTactic)) {
                $rolesInTactic[$role] = 1;
            } else {
                ++$rolesInTactic[$role];
            }
        }

        $lineupPlayers = [];
        foreach ($players as $player) {
            if (false === array_key_exists($player->role()->value, $rolesInTactic)) {
                continue;
            }
            if (true === array_key_exists($player->role()->value, $rolesInTactic)) {
                $lineupPlayers[] = $player;
                --$rolesInTactic[$player->role()->value];
            }
            if ($rolesInTactic[$player->role()->value] <= 0) {
                unset($rolesInTactic[$player->role()->value]);
            }
        }

        if (count($lineupPlayers) < 5) {
            throw new \Error('No tienes suficientes jugadores para esta táctica');
        }
        return $lineupPlayers;
    }
}