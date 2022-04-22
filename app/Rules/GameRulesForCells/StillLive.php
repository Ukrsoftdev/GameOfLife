<?php

namespace App\Rules\GameRulesForCells;

class StillLive extends BaseRule implements GameRuleInterface
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
        return 1;
    }

    /**
     * Any live cell with two or three live neighbors lives on to the next generation.
     * Determine if the validation rule passes.
     *
     * @return bool
     */
    protected function passes(): bool
    {
        $sum = count(array_filter($this->cell->getNeighbors()));
        return ($sum === 2 || $sum === 3);
    }
}
