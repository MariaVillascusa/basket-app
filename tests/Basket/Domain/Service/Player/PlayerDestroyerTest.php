<?php
declare(strict_types=1);

namespace App\Tests\Basket\Domain\Service\Player;

use App\Basket\Domain\Model\Player\Player;
use App\Basket\Domain\Service\Player\PlayerDestroyer;
use App\Basket\Infrastructure\Files\PlayerRepository;
use PHPUnit\Framework\TestCase;

final class PlayerDestroyerTest extends TestCase
{
    private int $playerNumber;
    private PlayerRepository $playerRepository;
    private Player $player;

    public function setUp(): void
    {
        $this->playerNumber = 8;
        $this->playerRepository = $this->createMock(PlayerRepository::class);
        $this->player = $this->createMock(Player::class);
    }

    /** @test */
    public function given_player_when_execute_then_deleted_player_number_is_returned(): void
    {
        $this->playerRepository
            ->expects(self::once())
            ->method('findByPlayerNumber')
            ->willReturn($this->player);

        $destroyer = new PlayerDestroyer($this->playerRepository);
        $result = $destroyer->execute($this->playerNumber);

        self::assertSame($this->player->playerNumber(), $result);
    }

    /** @test */
    public function given_null_player_when_execute_then_throws_error(): void
    {
        $this->playerRepository
            ->expects(self::once())
            ->method('findByPlayerNumber')
            ->willReturn(null);

        $this->expectError();

        $destroyer = new PlayerDestroyer($this->playerRepository);
        $destroyer->execute($this->playerNumber);
    }
}
