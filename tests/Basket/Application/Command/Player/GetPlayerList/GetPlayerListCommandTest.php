<?php
declare(strict_types=1);

namespace App\Tests\Basket\Application\Command\Player\GetPlayerList;

use App\Basket\Application\Command\Player\GetPlayersList\GetPlayersListCommand;
use PHPUnit\Framework\TestCase;

final class GetPlayerListCommandTest extends TestCase
{
    protected const VERSION = 1;
    protected const MODEL = 'player';
    protected const NAME = 'delete';


    /** @test */
    public function given_data_when_create_command_then_return_instance(): void
    {
        $command = GetPlayersListCommand::create();

        self::assertInstanceOf(GetPlayersListCommand::class, $command);
    }

    /** @test */
    public function given_command_when_get_instance_then_return_instance(): void
    {
        $command = GetPlayersListCommand::create();

        self::assertSame('fpdual.basket.1.command.player.list', $command::messageName());
    }
}
