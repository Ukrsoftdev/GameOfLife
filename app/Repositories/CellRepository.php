<?php

namespace App\Repositories;

use App\Models\Cell;
use App\Rules\GameRulesForCells\Overcrowding;
use App\Rules\GameRulesForCells\Reproduction;
use App\Rules\GameRulesForCells\StillLive;
use App\Rules\GameRulesForCells\Underpopulation;

class CellRepository implements CellRepositoryInterface
{

    /**
     * @param array|null $data
     * @return Cell
     */
    public function createCell(array $data = null): Cell
    {
        $cell = new Cell;

        if (isset($data['key'])) {
            $cell->setKey($data['key']);
        }

        if (isset($data['status'])) {
            $cell->setStatus($data['status']);
        }

        if (isset($data['neighbors'])) {
            $cell->setNeighbors($data['neighbors']);
        }

        return $cell;
    }

    /**
     * @param Cell $cell
     * @return Cell
     */
    public function updateCell(Cell $cell): Cell
    {
        $newCell = clone $cell;

        // Underpopulation Live Cell
        if (Underpopulation::make($cell)->validate()) {
            $newCell->setStatus(Underpopulation::getNewStatus());
        }

        // Still Live after generation
        if (StillLive::make($cell)->validate()) {
            $newCell->setStatus(StillLive::getNewStatus());
        }

        // Overcrowding Live Cells
        if (Overcrowding::make($cell)->validate()) {
            $newCell->setStatus(Overcrowding::getNewStatus());
        }

        // Reproduction dead Cell
        if (Reproduction::make($cell)->validate()) {
            $newCell->setStatus(Reproduction::getNewStatus());
        }

        return $newCell;
    }
}
