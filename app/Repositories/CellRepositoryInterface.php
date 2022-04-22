<?php

namespace App\Repositories;

use App\Models\Cell;

interface CellRepositoryInterface
{
    public function createCell(array $data = null): Cell;

    public function updateCell(Cell $cell): Cell;
}
