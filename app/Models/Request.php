<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    public function populationYears(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PopulationYear::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'requests';
}
