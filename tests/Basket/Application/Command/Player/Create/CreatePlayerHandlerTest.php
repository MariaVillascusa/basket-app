<?php
declare(strict_types=1);

namespace App\Tests\Basket\Application\Command\Player\Create;

use App\Basket\Application\Command\Player\Create\CreatePlayerCommand;
use App\Basket\Application\Command\Player\Create\CreatePlayerHandler as Handler;
use App\Basket\Domain\Model\Player\Player;
use App\Basket\Domain\Service\Player\PlayerCreator;
use PHPUnit\Framework\TestCase;

final class CreatePlayerHandlerTest extends TestCase
{
    private PlayerCreator $creator;

    protected function setUp(): void
    {
        $this->creator = $this->createMock(PlayerCreator::class);
    }

    /** @test */
    public function given_a_command_when_handler_then_success(): void
    {
        $player = Player::create(8, 'name', 'base', 100);

        $command = CreatePlayerCommand::create(
          $player->playerNumber(),
          $player->name(),
          $player->role()->value,
          $player->average()->value()
        );

        $this->creator->expects(self::once())
            ->method('execute')
            ->willReturn($player);

        $handler = new Handler($this->creator);
        $handler($command);
    }
}
