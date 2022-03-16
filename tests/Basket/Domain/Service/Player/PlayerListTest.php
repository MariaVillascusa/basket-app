<?php
declare(strict_types=1);

namespace App\Tests\Basket\Domain\Service\Player;

use App\Basket\Domain\Model\Player\Player;
use App\Basket\Domain\Service\Player\PlayerList;
use App\Basket\Infrastructure\Files\PlayerRepository;
use PHPUnit\Framework\TestCase;

final class PlayerListTest extends TestCase
{
    private PlayerRepository $repository;
    private Player $player;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(PlayerRepository::class);
        $this->player = $this->createMock(Player::class);
    }

    /** @test */
    public function given_data_when_execute_then_players_are_found(): void
    {
        $this->repository
            ->expects(self::once())
            ->method('findAll')
            ->willReturn([$this->player]);

        $list = new PlayerList($this->repository);
        $result = $list->execute();

        self::assertSame([$this->player], $result);
    }

    /** @test */
    public function given_empty_players_list_when_execute_then_throws_error(): void
    {
        $this->repository
            ->expects(self::once())
            ->method('findAll')
            ->willReturn([]);

        $this->expectError();

        $list = new PlayerList($this->repository);
        $list->execute();
    }
}
