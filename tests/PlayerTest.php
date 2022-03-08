<?php

namespace App\Tests;


use App\Domain\Model\Player\Player;

use App\Domain\Model\Player\ValueObject\Rol\Rol;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use PHPUnit\Framework\TestCase;


class PlayerTest extends TestCase
{
    private $playerNumber;
    private $name;
    private Rol $rol;
    private $average;

    protected function  setUp(): void
    {
        parent::setUp();

        $this->playerNumber = $this->createMock(Integer::class);
            $this->name = $this->createMock(String_::class);
            $this->rol = Rol::base;
            $this->average = $this->createMock(Integer::class);
    }

    public function test_create_player()
    {
        $player = Player::create(
            $this->playerNumber,
            $this->name,
            $this->rol,
            $this->average,
        );

        self::assertInstanceOf(Player::class, $player);
    }

    public function test_player_properties_are_created()
    {
        $player = Player::create(
            $this->playerNumber,
            $this->name,
            $this->rol,
            $this->average,
        );

        self::assertEquals($this->playerNumber, $player->playerNumber());
        self::assertEquals($this->name, $player->name());
        self::assertEquals($this->rol, $player->rol());
        self::assertEquals($this->average, $player->average());
    }
}