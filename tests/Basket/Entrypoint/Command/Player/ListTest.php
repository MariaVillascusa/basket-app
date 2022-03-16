<?php
declare(strict_types=1);

namespace App\Tests\Basket\Entrypoint\Command\Player;

use App\Basket\Domain\Model\Player\Player;
use App\Basket\Infrastructure\Files\PlayerRepository;
use PHPUnit\Framework\TestCase;

final class ListTest extends TestCase
{
    private PlayerRepository $repository;
    private Player $player1;
    private Player $player2;

    protected function setUp(): void
    {
        $this->repository = new PlayerRepository('/playersTest.csv');
        $this->player1 = Player::create(1, 'name1', 'base', 100);
        $this->player2 = Player::create(2, 'name2', 'base', 100);
        $this->repository->save($this->player1);
        $this->repository->save($this->player2);
    }

    protected function tearDown(): void
    {
        $this->repository->delete($this->player1->playerNumber());
        $this->repository->delete($this->player2->playerNumber());
    }

    /** @test */
    public function given_a_repository_when_list_then_get_all_players(): void
    {
        $players = $this->repository->findAll();

        self::assertSame($players[0], $this->player1);
        self::assertSame($players[1], $this->player2);
    }
}


