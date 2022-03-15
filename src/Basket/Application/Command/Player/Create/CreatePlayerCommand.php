<?php
declare(strict_types=1);

namespace App\Basket\Application\Command\Player\Create;

use App\Domain\Model\Player\ValueObject\Rol\Rol;
use App\System\Command;

final class CreatePlayerCommand extends Command
{
    protected const TYPE = 1;
    protected const MODEL = 'player';
    protected const NAME = 'create';

    private int $playerNumber;
    private string $name;
    private string $role;
    private int $average;

    private function __construct(int $playerNumber, string $name, string $role, int $average)
    {
        $this->playerNumber = $playerNumber;
        $this->name = $name;
        $this->role = $role;
        $this->average = $average;
    }

    public static function create(int $playerNumber, string $name, string $role, int $average): CreatePlayerCommand
    {
        return new CreatePlayerCommand($playerNumber, $name, $role, $average);
    }

    public function playerNumber(): int
    {
        return $this->playerNumber;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function role(): string
    {
        return $this->role;
    }

    public function average(): int
    {
        return $this->average;
    }
}