<?php

namespace App\Collections;

use Illuminate\Support\Collection;

class CellsCollection extends Collection
{
    /**
     * @param int $key
     * @return array
     */
    public function getNeighborsByKey(int $key): array
    {
        return
            $this->getNeighbor1($key)
            + $this->getNeighbor2($key)
            + $this->getNeighbor3($key)
            + $this->getNeighbor4($key)
            + $this->getNeighbor5($key)
            + $this->getNeighbor6($key)
            + $this->getNeighbor7($key)
            + $this->getNeighbor8($key);
    }

    /**
     * @param int $key
     * @return array
     */
    private function getNeighbor1(int $key): array
    {
        $qntCellsInRowOfSquare = config('game.qntCellsInRowOfSquare');
        $lastKey = $this->take(-1)->keys()->first();
        $firstKey = $this->take(1)->keys()->first();

        if (($keyNeighbor = $key - 1 - $qntCellsInRowOfSquare) < $firstKey) {
            $keyNeighbor += $lastKey;
        }

        return $this->get($keyNeighbor)->toArray();
    }

    /**
     * @param int $key
     * @return array
     */
    private function getNeighbor2(int $key): array
    {
        $qntCellsInRowOfSquare = config('game.qntCellsInRowOfSquare');
        $lastKey = $this->take(-1)->keys()->first();
        $firstKey = $this->take(1)->keys()->first();

        if (($keyNeighbor = $key - $qntCellsInRowOfSquare) < $firstKey) {
            $keyNeighbor += $lastKey;
        }

        return $this->get($keyNeighbor)->toArray();
    }

    /**
     * @param int $key
     * @return array
     */
    private function getNeighbor3(int $key): array
    {
        $qntCellsInRowOfSquare = config('game.qntCellsInRowOfSquare');
        $lastKey = $this->take(-1)->keys()->first();
        $firstKey = $this->take(1)->keys()->first();

        if (($keyNeighbor = $key + 1 - $qntCellsInRowOfSquare) < $firstKey) {
            $keyNeighbor += $lastKey;
        }

        return $this->get($keyNeighbor)->toArray();
    }

    /**
     * @param int $key
     * @return array
     */
    private function getNeighbor4(int $key): array
    {
        $firstKey = $this->take(1)->keys()->first();
        $lastKey = $this->take(-1)->keys()->first();

        if (($keyNeighbor = $key - 1) < $firstKey) {
            $keyNeighbor += $lastKey;
        }

        return $this->get($keyNeighbor)->toArray();
    }

    /**
     * @param int $key
     * @return array
     */
    private function getNeighbor5(int $key): array
    {
        $lastKey = $this->take(-1)->keys()->first();

        if (($keyNeighbor = $key + 1) > $lastKey) {
            $keyNeighbor -= $lastKey;
        }

        return $this->get($keyNeighbor)->toArray();
    }

    /**
     * @param int $key
     * @return array
     */
    private function getNeighbor6(int $key): array
    {
        $qntCellsInRowOfSquare = config('game.qntCellsInRowOfSquare');
        $lastKey = $this->take(-1)->keys()->first();

        if (($keyNeighbor = $key - 1 + $qntCellsInRowOfSquare) > $lastKey) {
            $keyNeighbor -= $lastKey;
        }

        return $this->get($keyNeighbor)->toArray();
    }

    /**
     * @param int $key
     * @return array
     */
    private function getNeighbor7(int $key): array
    {
        $qntCellsInRowOfSquare = config('game.qntCellsInRowOfSquare');
        $lastKey = $this->take(-1)->keys()->first();

        if (($keyNeighbor = $key + $qntCellsInRowOfSquare) > $lastKey) {
            $keyNeighbor -= $lastKey;
        }

        return $this->get($keyNeighbor)->toArray();
    }

    /**
     * @param int $key
     * @return array
     */
    private function getNeighbor8(int $key): array
    {
        $qntCellsInRowOfSquare = config('game.qntCellsInRowOfSquare');
        $lastKey = $this->take(-1)->keys()->first();

        if (($keyNeighbor = $key + 1 + $qntCellsInRowOfSquare) > $lastKey) {
            $keyNeighbor -= $lastKey;
        }
        return $this->get($keyNeighbor)->toArray();
    }
}
