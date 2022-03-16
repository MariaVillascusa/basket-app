<?php
declare(strict_types=1);

namespace App\Tests\Basket\Application\Command\Player\Create;

use App\Basket\Application\Command\Player\Create\CreatePlayerCommand;
use PHPUnit\Framework\TestCase;

final class CreatePlayerCommandTest extends TestCase
{
    protected const VERSION = 1;
    protected const MODEL = 'player';
    protected const NAME = 'create';

    private int $playerNumber;
    private string $name;
    private string $role;
    private int $average;

    public function setUp(): void
    {
        $this->playerNumber = 8;
        $this->name = 'name';
        $this->role = 'base';
        $this->average = 100;
    }

    /** @test */
    public function given_data_when_create_command_then_return_instance(): void
    {
        $command = CreatePlayerCommand::create(
            $this->playerNumber,
            $this->name,
            $this->role,
            $this->average
        );

        self::assertInstanceOf(CreatePlayerCommand::class, $command);
    }

    /** @test */
    public function given_command_when_get_instance_then_return_instance(): void
    {
        $command = CreatePlayerCommand::create(
            $this->playerNumber,
            $this->name,
            $this->role,
            $this->average
        );

        self::assertSame($this->playerNumber, $command->playerNumber());
        self::assertSame($this->name, $command->name());
        self::assertSame($this->role, $command->role());
        self::assertSame($this->average, $command->average());

        self::assertSame('fpdual.basket.1.command.player.create', $command::messageName());
    }

}
