<?php
declare(strict_types=1);

namespace App\Tests\Basket\Entrypoint\Command\Tactic;

use App\Basket\Application\Command\Tactic\Select\SelectTacticCommand;
use App\Basket\Application\Command\Tactic\Select\SelectTacticHandler;
use App\Basket\Domain\Model\Player\Player;

use App\Basket\Domain\Service\Player\PlayerOrder;
use App\Basket\Domain\Service\Tactic\TacticCalculator;
use App\Basket\Infrastructure\Files\PlayerRepository;
use PHPUnit\Framework\TestCase;

final class SelectTest extends TestCase
{
    private PlayerRepository $repository;
    private Player $player6;
    private array $players;

    protected function setUp(): void
    {
        $this->repository = new PlayerRepository('/playersTest.csv');
        $this->playerOrder = $this->createMock(PlayerOrder::class);
        $player1 = Player::create(1, 'player1', 'base', 50);
        $player2 = Player::create(2, 'player2', 'escolta', 50);
        $player3 = Player::create(3, 'player3', 'escolta', 50);
        $player4 = Player::create(4, 'player4', 'ala-pivot', 50);
        $player5 = Player::create(5, 'player5', 'pivot', 50);
        $this->player6 = Player::create(5, 'player6', 'pivot', 30);
        $this->players = [
            $player1,
            $player2,
            $player3,
            $player4,
            $player5,
        ];
        foreach ($this->players as $player) {
            $this->repository->save($player);
        }
        $this->repository->save($this->player6);
    }

    protected function tearDown(): void
    {
        foreach ($this->players as $player) {
            $this->repository->delete($player->playerNumber());
        }
        $this->repository->delete($this->player6->playerNumber());
    }

    /** @test */
    public function given_a_repository_when_select_tactic_then_get_lineup_players(): void
    {
        $command = SelectTacticCommand::create();
        $handler = new SelectTacticHandler(new TacticCalculator($this->repository, new PlayerOrder()));
        $players = $handler($command, 'Defensa');

        foreach ($players as $player) {
            self::assertContains($player, $this->players);
        }
        self::assertNotContains($this->player6, $this->players);
    }
}
