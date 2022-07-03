<?php

namespace App\Console\Commands;

use App\Helpers\Utilities;
use Illuminate\Console\Command;

class GetPopulation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'population:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the population of USA separated by years';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $result = Utilities::getPopulationFromApi();

        if ($result['success'] === true) {
            $this->info($result['message']);
        } else {
            $this->error($result['message']);
        }
    }
}
