<?php

    /*
     * The universe of the Game of Life is an infinite two-dimensional orthogonal grid of square cells, each of
     * which is in one of two possible states, alive or dead. Every cell interacts with its eight neighbors, which
     * are the cells that are horizontally, vertically, or diagonally adjacent.
     */

return [

    /*
    |--------------------------------------------------------------------------
    | The number of cells in one row of the Universe, which has a square shape
    |--------------------------------------------------------------------------
    |
    */

    'qntCellsInRowOfSquare' => 25,


    /*
    |--------------------------------------------------------------------------
    | Number of living cells from the initial state of the Universe
    |--------------------------------------------------------------------------
    |
    */

    'qntLiveCellsFromStart' => 5,

    /*
    |--------------------------------------------------------------------------
    | Status for Live and Dead cells
    |--------------------------------------------------------------------------
    | Use only int value
    */

    'liveCellStatus' => 1,
    'dedCellsStatus' => 0
];
