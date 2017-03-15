<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch', function (Blueprint $table) {
            $table->increments('id');
            $table->string('batchID')->unique();
            $table->string('batchName');
            $table->string('batchType');
            $table->string('programID');
            $table->string('yearCommenced');
            $table->string('noStages');
            $table->timestamps();
        });
         Schema::table('batch', function (Blueprint $table) {
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
        Schema::dropIfExists('batch');
    }
}
