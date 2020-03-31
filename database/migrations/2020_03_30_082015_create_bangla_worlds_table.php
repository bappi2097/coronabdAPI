<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanglaWorldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangla_worlds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('total_cases', 16)->default("0");
            $table->string('total_recovered', 16)->default("0");
            $table->string('total_deaths', 16)->default("0");
            $table->string('active_cases', 16)->default("0");
            $table->string('mild_cases', 16)->default("0");
            $table->string('critical_cases', 16)->default("0");
            $table->string('active_percentage', 20)->default("0");
            $table->string('recovered_percentage', 20)->default("0");
            $table->string('death_percentage', 20)->default("0");
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
        Schema::dropIfExists('bangla_worlds');
    }
}
