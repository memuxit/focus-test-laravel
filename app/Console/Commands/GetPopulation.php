<?php

namespace App\Console\Commands;

use App\Helpers\Utilities;
use App\Models\PopulationYear;
use App\Models\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $url = env('POPULATION_URL');

        $response = Http::timeout(5)
            ->connectTimeout(5)
            ->get($url, [
                'drilldowns' => 'Nation',
                'measures' => 'Population'
            ]);

        if ($response->successful()) {
            $years = $response->collect()->get('data');
            $populationYears = collect(new PopulationYear);

            foreach ($years as $year) {
                $populationYears->push(Utilities::buildPopulation($year));
            }

            try {
                DB::beginTransaction();

                $request = Request::create();
                $request->populationYears()->saveMany($populationYears->sortBy(['year', 'asc']));

                DB::commit();
            } catch (\Exception) {
                DB::rollBack();
                $this->error('There was an error saving the information');
            }

            $this->info('The information was obtained and saved correctly');
        } else {
            $this->error('An error occurred while getting the population');
        }
    }
}
