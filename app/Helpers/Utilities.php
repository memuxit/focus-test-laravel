<?php

namespace App\Helpers;

use App\Events\PopulationUpdated;
use App\Models\PopulationYear;
use App\Models\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Utilities
{
    /**
     * Build population year model
     *
     * @param array $population
     * @return PopulationYear
     */
    public static function buildPopulation(array $population): PopulationYear
    {
        $populationYear = new PopulationYear();
        $populationYear->id_nation = $population['ID Nation'];
        $populationYear->nation = $population['Nation'];
        $populationYear->year = (int)$population['Year'];
        $populationYear->population = $population['Population'];
        $populationYear->slug_nation = $population['Slug Nation'];

        return $populationYear;
    }

    /**
     * Get population by cache or database
     *
     * @return mixed|null
     */
    public static function getPopulation(): mixed
    {
        $population = Cache::get('population');

        if ($population === null) {
            $request = Request::orderBy('id', 'desc')->first();

            if ($request === null) {
                return null;
            }

            $population = $request->populationYears()->get();

            $cacheLifetime = env('CACHE_LIFETIME');
            Cache::put('population', $population, $cacheLifetime);
        }

        return $population;
    }

    /**
     * Get information from API and save in DB
     *
     * @return array
     */
    public static function getPopulationFromApi(): array
    {
        $url = env('POPULATION_URL');
        $timeout = env('GUZZLE_TIMEOUT');

        $response = Http::timeout($timeout)
            ->connectTimeout($timeout)
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

                event(new PopulationUpdated($request->populationYears()->get()));
            } catch (\Exception) {
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => 'There was an error saving the information'
                ];
            }

            return [
                'success' => true,
                'message' => 'The information was obtained and saved correctly'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'An error occurred while getting the population'
            ];
        }
    }
}
