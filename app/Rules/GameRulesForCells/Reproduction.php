<?php

namespace App\Rules\GameRulesForCells;

class Reproduction extends BaseRule implements GameRuleInterface
{
    /**
     * @var int
     */
    public static int $entryValidStatusCell = 0;

    /**
     * @return int
     */
    public static function getNewStatus(): int
    {
        return 1;
    }

    /**
     * Any dead cell with exactly three live neighbors becomes a live cell, as if by reproduction.
     * Determine if the validation rule passes.
     *
     * @return bool
     */
    protected function passes(): bool
    {
        return count(array_filter($this->cell->getNeighbors())) === 3;
    }
}
