<?php

namespace App\Console\Commands;

use App\Services\GeneratingUniverseService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class GenerateUniverse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Universe';

    /*
     * @var GeneratingUniverseService
     */
    private GeneratingUniverseService $generatingUniverseService;

    /**
     * @param GeneratingUniverseService $generatingUniverseService
     */
    public function __construct(GeneratingUniverseService $generatingUniverseService)
    {
        parent::__construct();
        $this->generatingUniverseService = $generatingUniverseService;
    }

    /**
     * @param array|null $data
     * @return int
     */
    public function handle(array $data = null): int
    {
        if($data === null) {
            $data = $this->generatingUniverseService->createNewUniverse();
        }

        $this->renderData($data);

        if ($this->confirm("\n Do you wish to generate next step?", true)) {
            $newData = $this->generatingUniverseService->generateNextUniverse($data);

            if ($data === $newData) {
                $this->renderData($newData);

                $this->info("The universe hasn't changed");
                $this->newLine(2);
                $this->error('Game over!');

                return 0;
            }

            if (empty(array_filter($newData))) {
                $this->renderData($newData);

                $this->info("No more lives cells");
                $this->newLine(2);
                $this->error('Game over!');

                return 0;
            }

            $this->handle($newData);
        }

        return 0;
    }

    /**
     * @param array $data
     * @return void
     */
    private function renderData(array $data): void
    {
        $table = new Table($this->output);

        $table->setHeaders(
            array_pad(
                range(1, config('game.qntCellsInRowOfSquare')),
                -1 - config('game.qntCellsInRowOfSquare'),
                null
            ));

        $table->setRows($this->getRowsData($data));

        $table->render();
    }

    /**
     * @param array $data
     * @return array
     */
    private function getRowsData(array $data): array
    {
        $data = array_chunk($data, config('game.qntCellsInRowOfSquare'));

        foreach ($data as $rowKey => $item) {
            foreach ($item as $cellKey => $cell) {
                    if ($cell === 0) {
                        $data[$rowKey][$cellKey] = '<bg=gray> </>';
                    }

                    if ($cell === 1) {
                        $data[$rowKey][$cellKey] = '<bg=red> </>';
                    }
            }
            $data[$rowKey] = array_pad($data[$rowKey], -1 - config('game.qntCellsInRowOfSquare'), '<fg=green>' . ($rowKey + 1) . '</>');
        }

        return $data;
    }
}
