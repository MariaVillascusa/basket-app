<?php
declare(strict_types=1);

namespace App\Tests\Basket\Entrypoint\Command\Player;

use App\Basket\Domain\Model\Player\Player;
use App\Basket\Infrastructure\Files\PlayerRepository;
use PHPUnit\Framework\TestCase;

final class CreateTest extends TestCase
{
    private PlayerRepository $repository;
    private Player $player;

    protected function setUp(): void
    {
        $this->repository = new PlayerRepository('/playersTest.csv');
        $this->player = Player::create(8, 'name', 'base', 100);
    }

    protected function tearDown(): void
    {
        $this->repository->delete($this->player->playerNumber());
    }

    /** @test */
    public function given_a_repository_when_save_then_player_is_stored(): void
    {
        $this->repository->save($this->player);

        $id = $this->player->playerNumber();
        $storedPlayer = $this->repository->findByPlayerNumber($id);

        self::assertSame($storedPlayer->playerNumber(), $this->player->playerNumber());
        self::assertSame($storedPlayer->name(), $this->player->name());
        self::assertSame($storedPlayer->role()->value, $this->player->role()->value);
        self::assertSame($storedPlayer->average()->value(), $this->player->average()->value());
    }
}
