<?php
declare(strict_types=1);

namespace App\Application\Command\Player\Delete;

use App\System\Command;

final class DeletePlayerCommand extends Command
{
    protected const TYPE = 1;
    protected const MODEL = 'player';
    protected const NAME = 'delete';

    private int $playerNumber;

    private function __construct(int $playerNumber)
    {
        $this->playerNumber = $playerNumber;
    }

    public static function create(int $playerNumber): DeletePlayerCommand
    {
        return new DeletePlayerCommand($playerNumber);
    }

    public function playerNumber(): int
    {
        return $this->playerNumber;
    }
}