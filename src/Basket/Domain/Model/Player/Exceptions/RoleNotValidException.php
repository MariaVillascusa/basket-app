<?php

namespace App\Basket\Domain\Model\Player\Exceptions;

class RoleNotValidException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct('El rol debe estar entre BASE, ALERO, PIVOT, ALA-PIVOT o ESCOLTA');
    }
}