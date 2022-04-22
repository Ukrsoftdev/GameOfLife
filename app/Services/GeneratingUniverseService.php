<?php

namespace App\Services;

use App\Models\Cell;
use App\Models\Universe;
use App\Repositories\CellRepositoryInterface;
use App\Repositories\UniverseRepositoryInterface;

class GeneratingUniverseService
{
    public function __construct(
        private UniverseRepositoryInterface $universeRepository,
        private CellRepositoryInterface     $cellRepository
    )
    {
    }

    /**
     * @return array
     */
    public function createNewUniverse(): array
    {

        $universe = $this->universeRepository->createUniverse();

        $universe = $this->addSeedCells($universe);

        return $universe->toArray();
    }

    /**
     * @param array $data
     * @return array
     */
    public function generateNextUniverse(array $data): array
    {
        $universe = $this->universeRepository->createUniverse($data);

        $universe = $this->updateCellsStatus($universe);

        return $universe->toArray();
    }

    /**
     * @param Universe $universe
     * @return Universe
     */
    private function addSeedCells(Universe $universe): Universe
    {
        $getKeyCellOfMidUniverse = round(count($universe->getCells()) / 2);

        $neighbors = $universe->getCells()->getNeighborsByKey($getKeyCellOfMidUniverse);

        $keysForLiveCells = array_rand($neighbors, config('game.qntLiveCellsFromStart'));

        foreach ($keysForLiveCells as $key) {
            /* @var Cell $cell */
            $cell = $universe->getCells()[$key];
            $cell->setStatus(config('game.liveCellStatus'));
        }

        return $universe;
    }

    /**
     * @param Universe $universe
     * @return Universe
     */
    private function updateCellsStatus(Universe $universe): Universe
    {
        $newUniverse = clone $universe;
        $universeCollection = $universe->getCells();

        foreach ($universeCollection as $key => $cell) {
            /* @var Cell $cell */

            if (empty($cell->getNeighbors())) {
                $cell->setNeighbors($universeCollection->getNeighborsByKey($key));
            }

            $newCell = $this->cellRepository->updateCell($cell);
            $newUniverse = $this->universeRepository->setCellByKey($newCell, $newUniverse);
        }

        return $newUniverse;
    }
}
