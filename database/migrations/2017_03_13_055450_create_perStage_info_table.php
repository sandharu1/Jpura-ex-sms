<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerStageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perstage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('batch_id');
            $table->string('stage_no');
            $table->string('perModules');
            $table->string('totcredits');
            $table->string('academicYear');
            $table->timestamps();
        });
         Schema::table('perstage', function (Blueprint $table) {
            $table->foreign('batch_id')
                    ->references('batchID')->on('batch')
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
        Schema::dropIfExists('perstage');
    }
}
