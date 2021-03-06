<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnglishBangladeshesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english_bangladeshes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total_cases')->default(0);
            $table->integer('total_recovered')->default(0);
            $table->integer('total_deaths')->default(0);
            $table->integer('active_cases')->default(0);
            $table->integer('total_quarantine')->default(0);
            $table->integer('finished_quarantine')->default(0);
            $table->integer('total_isolation')->default(0);
            $table->integer('finished_isolation')->default(0);
            $table->integer('critical_cases')->default(0);
            $table->double('active_percentage')->default(0.00);
            $table->double('recovered_percentage')->default(0.00);
            $table->double('death_percentage')->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('english_bangladeshes');
    }
}
