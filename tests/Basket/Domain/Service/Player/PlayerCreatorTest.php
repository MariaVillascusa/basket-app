<?php
declare(strict_types=1);

namespace App\Tests\Basket\Domain\Service\Player;

use App\Basket\Domain\Model\Player\Player;
use App\Basket\Domain\Service\Player\PlayerCreator;
use App\Basket\Infrastructure\Files\PlayerRepository;
use PHPUnit\Framework\TestCase;

final class PlayerCreatorTest extends TestCase
{
    private int $playerNumber;
    private string $name;
    private string $role;
    private int $average;
    private PlayerRepository $playerRepository;
    private Player $player;

    public function setUp(): void
    {
        $this->playerNumber = 8;
        $this->name = 'name';
        $this->role = 'base';
        $this->average = 100;
        $this->playerRepository = $this->createMock(PlayerRepository::class);
        $this->player = $this->createMock(Player::class);
    }

    /** @test */
    public function given_data_when_execute_then_player_is_created(): void
    {
        $this->playerRepository
            ->expects(self::once())
            ->method('findByPlayerNumber')
            ->willReturn(null);

        $creator = new PlayerCreator($this->playerRepository);
        $result = $creator->execute(
            $this->playerNumber,
            $this->name,
            $this->role,
            $this->average
        );

        self::assertInstanceOf(Player::class, $result);
    }

    /** @test */
    public function given_existing_player_number_when_execute_then_throws_error(): void
    {
        $this->playerRepository
            ->expects(self::once())
            ->method('findByPlayerNumber')
            ->willReturn($this->player);

        $this->expectError();

        (new PlayerCreator($this->playerRepository))
            ->execute(
                $this->playerNumber,
                $this->name,
                $this->role,
                $this->average
            );
    }
}
