<?php
declare(strict_types=1);

namespace App\Tests\Basket\Domain\Model\Tactic;

use App\Basket\Domain\Model\Tactic\Tactic;
use PHPUnit\Framework\TestCase;

final class TacticTest extends TestCase
{
    /** @test */
    public function given_clean_environment_when_create_tactic_then_return_tactic(): void
    {
        $player = new Tactic();

        self::assertInstanceOf(Tactic::class, $player);
    }
}
