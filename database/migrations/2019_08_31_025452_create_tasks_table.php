<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            
            $table->date('date');
            $table->string('name');
            $table->string('address');
            $table->double('latitude',19,0);
            $table->double('length',19,0);
            $table->integer('merchandise');
            $table->string('status');

            $table->unsignedInteger('id_dealer');
            $table->foreign('id_dealer')->references('id')->on('dealers');

            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
