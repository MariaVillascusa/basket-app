<?php
declare(strict_types=1);

namespace App\Domain\Model\Player;

use App\Domain\Model\Player\ValueObject\Rol\Rol;
use JsonSerializable;

final class Player implements JsonSerializable
{
    private int $playerNumber;
    private string $name;
    private Rol $rol;
    private int $average;

    private function __construct($playerNumber, $name, $rol, $average)
    {
        $this->playerNumber = $playerNumber;
        $this->name = $name;
        $this->rol = $rol;
        $this->average = $average;
    }

    public static function create($playerNumber, $name, $rol, $average): Player
    {
        return new Player($playerNumber, $name, $rol, $average);
    }


    public function playerNumber(): int
    {
        return $this->playerNumber;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function rol(): Rol
    {
        return $this->rol;
    }

    public function average(): int
    {
        return $this->average;
    }

    public function withAverage($average): void
    {
        $this->average = $average;
    }


    public function jsonSerialize(): array
    {
        return [
            'playerNumber'=> $this->playerNumber(),
            'name' => $this->name(),
            'rol' => $this->rol(),
            'average' => $this->average()
        ];
    }
}