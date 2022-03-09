<?php
declare(strict_types=1);

namespace App\Application\Player\Create;

use App\Domain\Service\Player\PlayerCreator;

final class CreatePlayerHandler
{
    private PlayerCreator $creator;

    public function __construct(PlayerCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreatePlayerCommand $command): void
    {
        $this->creator->execute(
            $command->playerNumber(),
            $command->name(),
            $command->rol(),
            $command->average()
        );
    }
}