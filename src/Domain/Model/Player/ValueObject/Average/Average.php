<?php

namespace App\Domain\Model\Player\ValueObject\Average;

use App\Domain\Model\Player\Exceptions\AverageNotValidException;

class Average
{
    private int $avg;


    public function __construct(int $avg)
    {
        if (!($avg >= 0 && $avg <= 100)) {
            throw new AverageNotValidException();
        }
        $this->avg = $avg;
    }

    public function value(): int
    {
        return $this->avg;
    }
}