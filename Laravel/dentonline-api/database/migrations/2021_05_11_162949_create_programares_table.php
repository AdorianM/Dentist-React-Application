<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programares', function (Blueprint $table) {
            $table->id();
            $table->integer('dentist_id');
            $table->string('dentist_name');
            $table->integer('user_id');
            $table->string('user_name');
            $table->date('date');
            $table->string('comment');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('dentist_id')->references('id')->on('dentists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programares');
    }
}
