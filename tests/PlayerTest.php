<?php

namespace App\Tests;


use App\Domain\Model\Player\Player;
use PHPUnit\Framework\TestCase;


class PlayerTest extends TestCase
{
    private int $playerNumber;
    private string $name;
    private string $role;
    private int $average;

    protected function  setUp(): void
    {
        parent::setUp();

        $this->playerNumber = 8;
            $this->name = 'Martínez';
            $this->role = 'BASE';
            $this->average = 9;
    }

    public function test_create_player()
    {
        $player = Player::create(
            $this->playerNumber,
            $this->name,
            $this->role,
            $this->average,
        );

        self::assertInstanceOf(Player::class, $player);
    }

    public function test_player_properties_are_created()
    {
        $player = Player::create(
            $this->playerNumber,
            $this->name,
            $this->role,
            $this->average,
        );

        self::assertEquals($this->playerNumber, $player->playerNumber());
        self::assertEquals($this->name, $player->name());
        self::assertEquals($this->role, $player->role()->value);
        self::assertEquals($this->average, $player->average());
    }
}