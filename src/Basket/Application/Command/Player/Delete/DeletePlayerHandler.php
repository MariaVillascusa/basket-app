<?php
declare(strict_types=1);

namespace App\Basket\Application\Command\Player\Delete;

use App\Basket\Domain\Service\Player\PlayerDestroyer;

final class DeletePlayerHandler
{
    private PlayerDestroyer $destroyer;

    public function __construct(PlayerDestroyer $destroyer)
    {
        $this->destroyer = $destroyer;
    }

    public function __invoke(DeletePlayerCommand $command): void
    {
        $this->destroyer->execute($command->playerNumber());
    }


}