<?php

namespace App\Repositories;

use App\Models\Cell;

interface CellRepositoryInterface
{
    public function updateCell(Cell $cell): Cell;
}
