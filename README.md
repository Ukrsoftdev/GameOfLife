# Game of Life (Laravel CLI example)

The universe of the Game of Life is an infinite two-dimensional orthogonal grid of square cells, each of which is in 
one of two possible states, alive or dead. Every cell interacts with its eight neighbors, which are the cells that 
are horizontally, vertically, or diagonally adjacent.

## Rules

**At each step** in time, the following transitions occur:
1. Any live cell with fewer than two live neighbors dies as **if caused by underpopulation**.
2. Any live cell with two or three live neighbors **lives on to the next generation**.
3. Any live cell with more than three live neighbors dies, as **if by overcrowding**.
4. Any dead cell with exactly three live neighbors becomes a live cell, as **if by reproduction**.
   
**The initial pattern** constitutes the seed of the system. The first generation is created by applying the above rules 
simultaneously to every cell in the seed—births and deaths occur simultaneously, and the discrete moment at which 
this happens is sometimes called a tick (in other words, each generation is a pure function of the preceding one). 
The rules continue to be applied repeatedly to create further generations.

**The game is over** when all Life cells are dead or the Universe has not changed since the generation. 

## Install game
1. Copy a repository from Github
2. Run `composer install`
3. Connect to Docker container `docker exec -it gameoflife_php-fpm_1 bash` (https://docs.docker.com/engine/reference/commandline/exec/) or use a globally installed PHP

## Run game
In CLI (from Docker container or with a globally installed PHP) run `php artisan game` and follow the 
instructions of the program.
###Enjoy the game)

## License

Game of Life is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
