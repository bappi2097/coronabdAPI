<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanglaBangladeshesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangla_bangladeshes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('total_cases', 16)->default("0");
            $table->string('total_recovered', 16)->default("0");
            $table->string('total_deaths', 16)->default("0");
            $table->string('active_cases', 16)->default("0");
            $table->string('mild_condition', 16)->default("0");
            $table->string('total_quarantine', 16)->default("0");
            $table->string('finished_quarantine', 16)->default("0");
            $table->string('total_isolation', 16)->default("0");
            $table->string('finished_isolation', 16)->default("0");
            $table->string('critical_condition', 16)->default("0");
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
        Schema::dropIfExists('bangla_bangladeshes');
    }
}
