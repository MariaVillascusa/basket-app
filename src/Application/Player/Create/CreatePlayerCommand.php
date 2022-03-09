<?php
declare(strict_types=1);

namespace App\Application\Player\Create;

use App\Domain\Model\Player\ValueObject\Rol\Rol;

final class CreatePlayerCommand
{
    private const NAME = 'create';
    private const VERSION = '1';

    private $playerNumber;
    private $name;
    private $rol;
    private $average;

    private function __construct(int $playerNumber, string $name, Rol $rol, int $average)
    {
        $this->playerNumber = $playerNumber;
        $this->name = $name;
        $this->rol = $rol;
        $this->average = $average;
    }

    public static function create(int $playerNumber, string $name, Rol $rol, int $average): CreatePlayerCommand
    {
        return new CreatePlayerCommand($playerNumber, $name, $rol, $average);
    }

    public function playerNumber()
    {
        return $this->playerNumber;
    }

    public function name()
    {
        return $this->name;
    }

    public function rol()
    {
        return $this->rol;
    }

    public function average()
    {
        return $this->average;
    }

    public function messageName(): string
    {
        return "fpdual.basket.1.command.Player.create";

    }
}