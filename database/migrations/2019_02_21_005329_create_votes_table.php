<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO(lm): incorporate start_at and ends_at cols
        // to check how many time takes the user to send their preferences

        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->json('preferences');
            $table->unsignedInteger('dynamic_id');
            $table->foreign('dynamic_id')->references('id')->on('dynamics');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('votes');
    }
}
