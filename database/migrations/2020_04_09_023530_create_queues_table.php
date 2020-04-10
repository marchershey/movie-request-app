<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id');
            $table->integer('tmdb_id');
            $table->integer('user_id');
            $table->string('ip', 15);
            $table->integer('votes')->default(1);
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
        Schema::dropIfExists('queues');
    }
}
