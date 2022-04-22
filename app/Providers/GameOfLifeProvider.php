<?php

namespace App\Providers;

use App\Repositories\CellRepository;
use App\Repositories\CellRepositoryInterface;
use App\Repositories\UniverseRepository;
use App\Repositories\UniverseRepositoryInterface;
use App\Rules\GameRulesForCells\GameRuleInterface;
use Illuminate\Support\ServiceProvider;

class GameOfLifeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CellRepositoryInterface::class, CellRepository::class);
        $this->app->bind(UniverseRepositoryInterface::class, UniverseRepository::class);
        $this->app->bind(GameRuleInterface::class, UniverseRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
