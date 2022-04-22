<?php

namespace App\Models;

use App\Collections\CellsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universe extends Model
{
    use HasFactory;

    /**
     * @var CellsCollection
     */
    private CellsCollection $cells;

    /**
     * @return CellsCollection
     */
    public function getCells(): CellsCollection
    {
        return $this->cells;
    }

    /**
     * @param CellsCollection $cells
     */
    public function setCells(CellsCollection $cells): void
    {
        $this->cells = $cells;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        if (empty($this->cells)) {
            return parent::toArray();
        }

        $response = [];
        foreach ($this->cells as $key => $cell) {
            /* @var Cell $cell */
            $response[$key] = $cell->getStatus();
        }

        return $response;
    }
}
