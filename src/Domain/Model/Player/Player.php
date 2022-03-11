<?php
declare(strict_types=1);

namespace App\Domain\Model\Player;

use App\Domain\Model\Player\ValueObject\Role\Role;
use Error;
use JsonSerializable;

final class Player implements JsonSerializable
{
    private int $playerNumber;
    private string $name;
    private Role $role;
    private int $average;

    private function __construct($playerNumber, $name, $role, $average)
    {
        $this->playerNumber = $playerNumber;
        $this->name = $name;
        $this->role = $role;
        $this->average = $average;
    }

    public static function create($playerNumber, $name, $role, $average): Player
    {
        $createdRole = self::validateRole($role);
        return new Player($playerNumber, $name, $createdRole, $average);
    }

    /**
     * @param $role
     * @return role
     * @throws Error
     */
    public static function validateRole($role): Role
    {
        $createdRole = role::tryFrom(strtoupper($role));
        if ($createdRole === null) {
            throw new Error('No existe ese rol.');
//            throw new \Exception('No existe ese rol');
        }
        return $createdRole;
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
            'playerNumber' => $this->playerNumber(),
            'name' => $this->name(),
            'role' => $this->role(),
            'average' => $this->average()
        ];
    }
}