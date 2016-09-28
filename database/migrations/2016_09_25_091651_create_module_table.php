<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('module_id')->unique();
            $table->string('programID');
            $table->string('credits');
            $table->string('year_commenced');
            $table->timestamps();
        });
        Schema::table('module', function (Blueprint $table) {
            $table->foreign('programID')
                    ->references('program_id')->on('program')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module');
    }
}
