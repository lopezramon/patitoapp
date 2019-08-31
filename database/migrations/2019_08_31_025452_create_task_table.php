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
            
            $table->string('date');
            $table->string('name');
            $table->string('address');
            $table->doble('latitude',19,0);
            $table->doble('length',19,0);
            $table->integer('merchandise');
            $table->string('status');

            $table->unsignedInteger('id_ditributor');
            $table->foreign('id_ditributor')->references('id')->on('ditributors');

            
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
