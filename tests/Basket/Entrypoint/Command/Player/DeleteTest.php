<?php
declare(strict_types=1);

namespace App\Tests\Basket\Entrypoint\Command\Player;

use App\Basket\Domain\Model\Player\Player;
use App\Basket\Infrastructure\Files\PlayerRepository;
use PHPUnit\Framework\TestCase;

final class DeleteTest extends TestCase
{
    private PlayerRepository $repository;
    private Player $player;

    protected function setUp(): void
    {
        $this->repository = new PlayerRepository('/playersTest.csv');
        $this->player = Player::create(8, 'name', 'base', 100);
        $this->repository->save($this->player);
    }

    /** @test */
    public function given_a_repository_when_delete_then_player_deleted(): void
    {
        $id = $this->player->playerNumber();
        $this->repository->delete($id);

        $deletedPlayer = $this->repository->findByPlayerNumber($id);

        self::assertNull($deletedPlayer);
    }
}
