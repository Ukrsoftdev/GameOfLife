<?php

namespace App\Rules\GameRulesForCells;

class Overcrowding extends BaseRule implements GameRuleInterface
{
    /**
     * @var int
     */
    public static int $entryValidStatusCell = 1;

    /**
     * @return int
     */
    public static function getNewStatus(): int
    {
        return 0;
    }

    /**
     * Any live cell with more than three live neighbors dies, as if by overcrowding.
     * Determine if the validation rule passes.
     *
     * @return bool
     */
    protected function passes(): bool
    {
        return count(array_filter($this->cell->getNeighbors())) > 3;
    }
}
