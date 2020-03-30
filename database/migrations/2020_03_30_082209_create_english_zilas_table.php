<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnglishZilasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english_zilas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('zila_name', 64)->nullable();
            $table->integer('total_cases')->default(0);
            $table->integer('total_recovered')->default(0);
            $table->integer('total_deaths')->default(0);
            $table->integer('active_cases')->default(0);
            $table->double('active_percentage')->default(0.00);
            $table->double('recovered_percentage')->default(0.00);
            $table->double('death_percentage')->default(0.00);
            $table->integer('quarantine')->default(0);
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
        Schema::dropIfExists('english_zilas');
    }
}
