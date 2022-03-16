<?php
declare(strict_types=1);

namespace App\Tests\Basket\Domain\Service\Tactic;

use App\Basket\Domain\Model\Player\Player;
use App\Basket\Domain\Model\Player\PlayerRepository;
use App\Basket\Domain\Service\Player\PlayerOrder;
use App\Basket\Domain\Service\Tactic\TacticCalculator;
use PHPUnit\Framework\TestCase;

final class TacticCalculatorTest extends TestCase
{
    private PlayerRepository $repository;
    private PlayerOrder $playerOrder;
    private Player $player1;
    private Player $player2;
    private Player $player3;
    private Player $player4;
    private Player $player5;
    private array $players;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(PlayerRepository::class);
        $this->playerOrder = $this->createMock(PlayerOrder::class);
        $this->player1 = Player::create(1, 'playerWithLowerNumber', 'base', 50);
        $this->player2 = Player::create(2, 'playerWithLowerNumber', 'escolta', 50);
        $this->player3 = Player::create(3, 'playerWithLowerNumber', 'escolta', 50);
        $this->player4 = Player::create(4, 'playerWithLowerNumber', 'ala-pivot', 50);
        $this->player5 = Player::create(5, 'playerWithLowerNumber', 'pivot', 50);
        $this->players = [
            $this->player1,
            $this->player2,
            $this->player3,
            $this->player4,
            $this->player5,
        ];
    }

    /** @test */
    public function given_data_when_execute_then_lineup_players_are_calculated(): void
    {
        $this->repository
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($this->players);

        $this->playerOrder
            ->expects(self::once())
            ->method('order')
            ->willReturn($this->players);

        $list = new TacticCalculator($this->repository, $this->playerOrder);
        $result = $list->execute('Defensa');

        self::assertSame($this->players, $result);
    }
}
