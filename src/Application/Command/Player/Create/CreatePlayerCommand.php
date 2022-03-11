<?php
declare(strict_types=1);

namespace App\Application\Command\Player\Create;

use App\Domain\Model\Player\ValueObject\Rol\Rol;
use App\System\Command;

final class CreatePlayerCommand extends Command
{
    protected const COMPANY = 'fpdual';
    protected const PROJECT = 'basket';
    protected const VERSION = '1';
    protected const TYPE = 'command';
    protected const MODEL = 'Player';
    protected const NAME = 'create:player';

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

    public function playerNumber()
    {
        return $this->playerNumber;
    }

    public function name()
    {
        return $this->name;
    }

    public function role()
    {
        return $this->role;
    }

    public function average()
    {
        return $this->average;
    }
}