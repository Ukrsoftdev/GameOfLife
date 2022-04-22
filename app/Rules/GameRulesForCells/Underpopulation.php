<?php

namespace App\Rules\GameRulesForCells;

class Underpopulation extends BaseRule implements GameRuleInterface
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
     * Any live cell with fewer than two live neighbors dies as if caused by underpopulation.
     * Determine if the validation rule passes.
     *
     * @return bool
     */
    protected function passes(): bool
    {
        return count(array_filter($this->cell->getNeighbors())) < 2;
    }
}
