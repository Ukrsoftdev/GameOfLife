<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universe extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    private array $cells;

    /**
     * @return int
     */
    public static function getQntCellsInRow(): int
    {
        return config('game.qntCellsInRowOfSquare');
    }

    /**
     * @return array
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    /**
     * @param array $cells
     */
    public function setCells(array $cells): void
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
