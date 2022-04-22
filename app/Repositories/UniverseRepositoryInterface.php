<?php

namespace App\Repositories;

use App\Models\Cell;
use App\Models\Universe;

interface UniverseRepositoryInterface
{
    public function createUniverse(): Universe;

    public function setCellByKey(Cell $cell, Universe $universe): Universe;
}
