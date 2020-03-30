<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanglaZilasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangla_zilas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('zila_name', 64)->nullable();
            $table->string('zila_name_bangla', 64)->nullable();
            $table->string('total_cases', 16)->default("0");
            $table->string('total_recovered', 16)->default("0");
            $table->string('total_deaths', 16)->default("0");
            $table->string('active_cases', 16)->default("0");
            $table->string('active_percentage', 20)->default("0");
            $table->string('recovered_percentage', 20)->default("0");
            $table->string('death_percentage', 20)->default("0");
            $table->string('quarantine', 16)->default("0");
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
        Schema::dropIfExists('bangla_zilas');
    }
}
