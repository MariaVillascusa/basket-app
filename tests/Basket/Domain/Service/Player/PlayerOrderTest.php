<?php
declare(strict_types=1);

namespace App\Tests\Basket\Domain\Service\Player;

use App\Basket\Domain\Model\Player\Player;
use App\Basket\Domain\Service\Player\PlayerOrder;
use PHPUnit\Framework\TestCase;

final class PlayerOrderTest extends TestCase
{
    private Player $playerWithHigherNumber;
    private Player $playerWithLowerNumber;
    private Player $playerWithHigherAverage;
    private Player $playerWithLowerAverage;
    private array $players;

    protected function setUp(): void
    {
        $this->playerWithHigherNumber = Player::create(10, 'playerWithHigherNumber', 'base', 60);
        $this->playerWithLowerNumber = Player::create(1, 'playerWithLowerNumber', 'base', 50);
        $this->playerWithHigherAverage = Player::create(6, 'playerWithHigherAverage', 'base', 100);
        $this->playerWithLowerAverage = Player::create(5, 'playerWithLowerAverage', 'base', 10);
        $this->players = [
            $this->playerWithHigherNumber,
            $this->playerWithLowerNumber,
            $this->playerWithHigherAverage,
            $this->playerWithLowerAverage
        ];
    }

    /** @test */
    public function given_empty_filter_when_execute_then_players_are_not_ordered(): void
    {
        $ordinate = new PlayerOrder;
        $notOrderedPlayers = $ordinate->order($this->players, '');

        $this->assertSame($notOrderedPlayers, [
            $this->playerWithHigherNumber,
            $this->playerWithLowerNumber,
            $this->playerWithHigherAverage,
            $this->playerWithLowerAverage
        ]);
    }

    /** @test */
    public function given_dorsal_filter_when_execute_then_players_are_not_ordered(): void
    {
        $ordinate = new PlayerOrder;
        $orderedPlayersByNumber = $ordinate->order($this->players, 'dorsal');

        $this->assertSame(
            array_values($orderedPlayersByNumber),
            array_values([
            $this->playerWithLowerNumber,
            $this->playerWithLowerAverage,
            $this->playerWithHigherAverage,
            $this->playerWithHigherNumber,
        ]));
    }

    /** @test */
    public function given_average_filter_when_execute_then_players_are_not_ordered(): void
    {
        $ordinate = new PlayerOrder;
        $orderedPlayersByAverage = $ordinate->order($this->players, 'media');

        $this->assertSame(
            array_values($orderedPlayersByAverage),
            array_values([
            $this->playerWithHigherAverage,
            $this->playerWithHigherNumber,
            $this->playerWithLowerNumber,
            $this->playerWithLowerAverage
        ]));
    }
}
