<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnglishWorldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english_worlds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total_cases')->default(0);
            $table->integer('total_recovered')->default(0);
            $table->integer('total_deaths')->default(0);
            $table->integer('active_cases')->default(0);
            $table->integer('mild_condition')->default(0);
            $table->integer('critical_condition')->default(0);
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
        Schema::dropIfExists('english_worlds');
    }
}
