<?php

namespace App\Helpers;

use App\Models\PopulationYear;
use App\Models\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Utilities
{
    /**
     * Build population year model
     *
     * @param array $population
     * @return PopulationYear
     */
    public static function buildPopulation(Array $population): PopulationYear
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
}
