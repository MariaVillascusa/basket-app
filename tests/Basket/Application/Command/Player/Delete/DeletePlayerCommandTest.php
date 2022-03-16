<?php
declare(strict_types=1);

namespace App\Tests\Basket\Application\Command\Player\Delete;

use App\Basket\Application\Command\Player\Delete\DeletePlayerCommand;
use PHPUnit\Framework\TestCase;

final class DeletePlayerCommandTest extends TestCase
{
    protected const VERSION = 1;
    protected const MODEL = 'player';
    protected const NAME = 'delete';

    private int $playerNumber;

    public function setUp(): void
    {
        $this->playerNumber = 8;
    }

    /** @test */
    public function given_data_when_create_command_then_return_instance(): void
    {
        $command = DeletePlayerCommand::create(
            $this->playerNumber,
        );

        self::assertInstanceOf(DeletePlayerCommand::class, $command);
    }

    /** @test */
    public function given_command_when_get_instance_then_return_instance(): void
    {
        $command = DeletePlayerCommand::create(
            $this->playerNumber,
        );

        self::assertSame($this->playerNumber, $command->playerNumber());

        self::assertSame('fpdual.basket.1.command.player.delete', $command::messageName());
    }
}
