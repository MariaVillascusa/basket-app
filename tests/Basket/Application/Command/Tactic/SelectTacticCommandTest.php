<?php
declare(strict_types=1);

namespace App\Tests\Basket\Application\Command\Tactic;

use App\Basket\Application\Command\Tactic\Select\SelectTacticCommand;
use PHPUnit\Framework\TestCase;

final class SelectTacticCommandTest extends TestCase
{
    protected const VERSION = 1;
    protected const MODEL = 'tactic';
    protected const NAME = 'select';


    /** @test */
    public function given_data_when_create_command_then_return_instance(): void
    {
        $command = SelectTacticCommand::create();

        self::assertInstanceOf(SelectTacticCommand::class, $command);
    }

    /** @test */
    public function given_command_when_get_instance_then_return_instance(): void
    {
        $command = SelectTacticCommand::create();

        self::assertSame('fpdual.basket.1.command.tactic.select', $command::messageName());
    }
}
