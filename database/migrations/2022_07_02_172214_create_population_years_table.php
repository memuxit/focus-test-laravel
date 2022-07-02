<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('population_years', function (Blueprint $table) {
            $table->id();
            $table->string('id_nation');
            $table->string('nation');
            $table->integer('year');
            $table->integer('population');
            $table->string('slug_nation');
            $table->foreignId('request_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('population_years');
    }
};
