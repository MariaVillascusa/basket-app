<?php
declare(strict_types=1);

namespace App\Tests\Basket\Application\Command\Tactic;

use App\Basket\Application\Command\Tactic\Select\SelectTacticCommand;
use App\Basket\Application\Command\Tactic\Select\SelectTacticHandler as Handler;
use App\Basket\Domain\Model\Tactic\Tactic;
use App\Basket\Domain\Service\Tactic\TacticCalculator;
use PHPUnit\Framework\TestCase;

final class SelectTacticHandlerTest extends TestCase
{
private TacticCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = $this->createMock(TacticCalculator::class);
    }

    /** @test */
    public function given_a_command_when_handler_then_success(): void
    {
        $command = SelectTacticCommand::create();

        $this->calculator->expects(self::once())
            ->method('execute')
            ->willReturn([]);

        $handler = new Handler($this->calculator);
        $handler($command,'');
    }
}
