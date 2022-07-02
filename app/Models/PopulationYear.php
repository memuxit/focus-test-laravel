<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopulationYear extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_nation',
        'nation',
        'year',
        'population',
        'slug_nation',
        'request_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'population_years';
}
