<?php

namespace App\Domain\Model\Player\Exceptions;

use Throwable;

class AverageNotValidException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct('La media no es válida');
    }

}