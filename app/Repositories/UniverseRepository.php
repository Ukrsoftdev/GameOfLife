<?php

namespace App\Repositories;

use App\Collections\CellsCollection;
use App\Models\Cell;
use App\Models\Universe;

class UniverseRepository implements UniverseRepositoryInterface
{
    /**
     * @param CellRepositoryInterface $cellRepository
     */
    public function __construct(
        private CellRepositoryInterface $cellRepository
    )
    {
    }

    /**
     * @param array|null $data
     * @return Universe
     */
    public function createUniverse(array $data = null): Universe
    {
        $universe = new Universe();
        $cells = [];

        if ($data === null) {
            $data = array_fill(1, config('game.qntCellsInRowOfSquare') ** 2, config('game.dedCellsStatus'));
        }

        foreach ($data as $key => $cell) {
            $cells[$key] = $this->cellRepository->createCell([
                'key' => $key,
                'status' => $cell
            ]);
        }

        $universe->setCells(new CellsCollection($cells));

        return $universe;
    }

    /**
     * @param Cell $cell
     * @param Universe $universe
     * @return Universe
     */
    public function setCellByKey(Cell $cell, Universe $universe): Universe
    {
        $cells = $universe->getCells();

        if (isset($cells[$cell->getKey()])) {
            $cells[$cell->getKey()] = $cell;
            $universe->setCells($cells);
        }

        return $universe;
    }
}
