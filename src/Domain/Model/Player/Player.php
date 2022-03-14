<?php
declare(strict_types=1);

namespace App\Domain\Model\Player;

use App\Domain\Model\Player\ValueObject\Average\Average;
use App\Domain\Model\Player\ValueObject\Role\Role;
use Error;
use JsonSerializable;

final class Player implements JsonSerializable
{
    private int $playerNumber;
    private string $name;
    private Role $role;
    private Average $average;

    private function __construct(int $playerNumber, string $name, Role $role, Average $average)
    {
        $this->playerNumber = $playerNumber;
        $this->name = $name;
        $this->role = $role;
        $this->average = $average;
    }


    public static function create(int $playerNumber, string $name, string $role, int $average): Player
    {
        $createdRole = Role::tryGetFrom($role);
        $createdAverage = new Average($average);

        return new Player($playerNumber, $name, $createdRole, $createdAverage);
    }

    public function playerNumber(): int
    {
        return $this->playerNumber;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function role(): Role
    {
        return $this->role;
    }

    public function average(): Average
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
            'playerNumber' => $this->playerNumber(),
            'name' => $this->name(),
            'role' => $this->role()->value,
            'average' => $this->average()->value()
        ];
    }

    public function __toString(): string
    {
        return $this->playerNumber() . "\t" .
            $this->name() . "\t" .
            $this->role()->value . "\t\t" .
            $this->average()->value();
    }


}