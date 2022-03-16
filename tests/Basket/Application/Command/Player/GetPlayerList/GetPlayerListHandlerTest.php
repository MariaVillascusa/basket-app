<?php
declare(strict_types=1);

namespace App\Tests\Basket\Application\Command\Player\GetPlayerList;

use App\Basket\Application\Command\Player\GetPlayersList\GetPlayersListCommand;
use App\Basket\Application\Command\Player\GetPlayersList\GetPlayersListHandler as Handler;
use App\Basket\Domain\Model\Player\Player;
use App\Basket\Domain\Service\Player\PlayerList;
use App\Basket\Domain\Service\Player\PlayerOrder;
use PHPUnit\Framework\TestCase;

final class GetPlayerListHandlerTest extends TestCase
{
    private PlayerList $list;
    private PlayerOrder $order;
    private array $players;

    protected function setUp(): void
    {
        $this->list = $this->createMock(PlayerList::class);
        $this->order = $this->createMock(PlayerOrder::class);
        $this->players[] = Player::create(8, 'name', 'base', 100);
    }

    /** @test */
    public function given_a_command_when_handler_then_success(): void
    {
        $command = GetPlayersListCommand::create();

        $this->list->expects(self::once())
            ->method('execute')
            ->willReturn($this->players);

        $this->order->expects(self::once())
            ->method('order')
            ->willReturn($this->players);

        $handler = new Handler($this->list, $this->order);
        $handler($command, '');
    }
}
