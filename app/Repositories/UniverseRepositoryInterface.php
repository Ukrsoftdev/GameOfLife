<?php

namespace App\Repositories;

use App\Models\Universe;

interface UniverseRepositoryInterface
{
    public function createUniverse(): Universe;
}
