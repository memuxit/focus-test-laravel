<?php

namespace App\Helpers;

use App\Models\PopulationYear;
use Illuminate\Support\Arr;

class Utilities
{
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
}
