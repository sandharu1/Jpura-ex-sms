<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nic');
            $table->string('student_id');
            $table->string('moduleID');
            $table->bigInteger('mark');
            $table->string('attempt');
            $table->string('grade');
            $table->string('year');
            $table->timestamps();
        });
        Schema::table('module_marks', function (Blueprint $table) {

            $table->foreign('moduleID')
                    ->references('module_id')->on('module')
                    ->onDelete('cascade');
            $table->string('credit');
            $table->string('gpa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_marks');
    }
}
