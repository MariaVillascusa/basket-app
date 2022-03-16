<?php
declare(strict_types=1);

namespace App\Tests\Basket\Application\Command\Player\Delete;

use App\Basket\Application\Command\Player\Delete\DeletePlayerCommand;
use App\Basket\Application\Command\Player\Delete\DeletePlayerHandler as Handler;
use App\Basket\Domain\Model\Player\Player;
use App\Basket\Domain\Service\Player\PlayerDestroyer;
use PHPUnit\Framework\TestCase;

final class DeletePlayerHandlerTest extends TestCase
{
    private PlayerDestroyer $destroyer;

    protected function setUp(): void
    {
        $this->destroyer = $this->createMock(PlayerDestroyer::class);
    }

    /** @test */
    public function given_a_command_when_handler_then_success(): void
    {
        $player = Player::create(8, 'name', 'base', 100);

        $command = DeletePlayerCommand::create(
            $player->playerNumber(),
        );

        $this->destroyer->expects(self::once())
            ->method('execute')
            ->willReturn($player->playerNumber());

        $handler = new Handler($this->destroyer);
        $handler($command);
    }
}
