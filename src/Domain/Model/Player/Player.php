<?php
declare(strict_types=1);

namespace App\Domain\Model\Player;

use App\Domain\Model\Player\ValueObject\Rol\Rol;
use JsonSerializable;

final class Player implements JsonSerializable
{
    private $playerNumber;
    private $name;
    private Rol $rol;
    private $average;

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

    public function withAverage($average): void
    {
        $this->average = $average;
    }


    public function jsonSerialize(): mixed
    {
        return [
            'playerNumber'=> $this->playerNumber(),
            'name' => $this->name(),
            'rol' => $this->rol(),
            'average' => $this->average()
        ];
    }
}