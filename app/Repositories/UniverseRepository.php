<?php

namespace App\Repositories;

use App\Models\Cell;
use App\Models\Universe;

class UniverseRepository implements UniverseRepositoryInterface
{
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

        if($data === null) {
            $data = array_fill(1, Universe::getQntCellsInRow() ** 2, config('game.dedCellsStatus'));
        }

        foreach ($data as $key => $cell) {
            $cells[$key] = $this->cellRepository->createCell([
                'key' => $key,
                'status' => $cell
            ]);
        }

        $universe->setCells($cells);

        return $universe;
    }

    public function setCellByKey(Cell $cell, Universe $universe): Universe
    {
        $cells = $universe->getCells();

        if (isset($cells[$cell->getKey()])) {
            $cells[$cell->getKey()] = $cell;
            $universe->setCells($cells);
        }

        return $universe;
    }

    /**
     * @param int $key
     * @param Universe $universe
     * @return array
     */
    public function getNeighborsKeys(int $key, Universe $universe): array
    {
        return [
            $this->getKeyNeighbor1($key, $universe),
            $this->getKeyNeighbor2($key, $universe),
            $this->getKeyNeighbor3($key, $universe),
            $this->getKeyNeighbor4($key, $universe),
            $this->getKeyNeighbor5($key, $universe),
            $this->getKeyNeighbor6($key, $universe),
            $this->getKeyNeighbor7($key, $universe),
            $this->getKeyNeighbor8($key, $universe)
        ];
    }

    /**
     * @param int $key
     * @param Universe $universe
     * @return int
     */
    private function getKeyNeighbor1(int $key, Universe $universe): int
    {
        if (($keyNeighbor = $key - 1 - Universe::getQntCellsInRow()) <= 0) {
            $keyNeighbor += array_key_last($universe->getCells());
        }
        return $keyNeighbor;
    }

    /**
     * @param int $key
     * @param Universe $universe
     * @return int
     */
    private function getKeyNeighbor2(int $key, Universe $universe): int
    {
        if (($keyNeighbor = $key - Universe::getQntCellsInRow()) <= 0) {
            $keyNeighbor += array_key_last($universe->getCells());
        }
        return $keyNeighbor;
    }

    /**
     * @param int $key
     * @param Universe $universe
     * @return int
     */
    private function getKeyNeighbor3(int $key, Universe $universe): int
    {
        if (($keyNeighbor = $key + 1 - Universe::getQntCellsInRow()) <= 0) {
            $keyNeighbor += array_key_last($universe->getCells());
        }
        return $keyNeighbor;
    }

    /**
     * @param int $key
     * @param Universe $universe
     * @return int
     */
    private function getKeyNeighbor4(int $key, Universe $universe): int
    {
        if (($keyNeighbor = $key - 1) <= 0) {
            $keyNeighbor += array_key_last($universe->getCells());
        }
        return $keyNeighbor;
    }

    /**
     * @param int $key
     * @param Universe $universe
     * @return int
     */
    private function getKeyNeighbor5(int $key, Universe $universe): int
    {
        if (($keyNeighbor = $key + 1) > array_key_last($universe->getCells())) {
            $keyNeighbor -= array_key_last($universe->getCells());
        }
        return $keyNeighbor;
    }

    /**
     * @param int $key
     * @param Universe $universe
     * @return int
     */
    private function getKeyNeighbor6(int $key, Universe $universe): int
    {
        if (($keyNeighbor = $key - 1 + Universe::getQntCellsInRow()) > array_key_last($universe->getCells())) {
            $keyNeighbor -= array_key_last($universe->getCells());
        }
        return $keyNeighbor;
    }

    /**
     * @param int $key
     * @param Universe $universe
     * @return int
     */
    private function getKeyNeighbor7(int $key, Universe $universe): int
    {
        if (($keyNeighbor = $key + Universe::getQntCellsInRow()) > array_key_last($universe->getCells())) {
            $keyNeighbor -= array_key_last($universe->getCells());
        }
        return $keyNeighbor;
    }

    /**
     * @param int $key
     * @param Universe $universe
     * @return int
     */
    private function getKeyNeighbor8(int $key, Universe $universe): int
    {
        if (($keyNeighbor = $key + 1 + Universe::getQntCellsInRow()) > array_key_last($universe->getCells())) {
            $keyNeighbor -= array_key_last($universe->getCells());
        }
        return $keyNeighbor;
    }
}
