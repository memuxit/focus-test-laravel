<?php

namespace App\Http\Controllers;

use App\Helpers\Utilities;

class PopulationController extends Controller
{
    /**
     * Get population via API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $population = Utilities::getPopulation();

        return response()->json([
           'success' => $population !== null,
           'message' => $population === null ? 'No records found' : 'Records found successfully',
            'data' => $population,
        ]);
    }
}
