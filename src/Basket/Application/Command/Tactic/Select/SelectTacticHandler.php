<?php

namespace App\Basket\Application\Command\Tactic\Select;

use App\Basket\Domain\Service\Tactic\TacticCalculator;

class SelectTacticHandler
{
    private TacticCalculator $calculator;

    /**
     * @param TacticCalculator $calculator
     */
    public function __construct(TacticCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function __invoke(SelectTacticCommand $command, $tactic): array
    {
        return $this->calculator->execute($tactic);
    }


}