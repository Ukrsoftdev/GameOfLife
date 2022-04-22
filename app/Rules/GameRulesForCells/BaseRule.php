<?php

namespace App\Rules\GameRulesForCells;

use App\Models\Cell;

abstract class BaseRule
{
    /**
     * @var Cell
     */
    protected Cell $cell;

    /**
     * @param Cell $cell
     */
    public function __construct(Cell $cell)
    {
        $this->cell = $cell;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        if ($this->ifEntryStatusWrong()) {
            return false;
        }

        if (!$this->passes()) {
            return false;
        }

        return true;
    }

    /**
     * @param Cell $cell
     * @return static
     */
    public static function make(Cell $cell): static
    {
        return new static($cell);
    }

    /**
     * @return int
     */
    abstract public static function getNewStatus(): int;

    /**
     * Determine if the validation rule passes.
     * @return bool
     */
    abstract protected function passes(): bool;

    /**
     * @return bool
     */
    private function ifEntryStatusWrong(): bool
    {
        return $this->cell->getStatus() !== $this->getValidStatusCell();
    }

    /**
     * @return int
     */
    private function getValidStatusCell(): int
    {
        return static::$entryValidStatusCell;
    }
}
