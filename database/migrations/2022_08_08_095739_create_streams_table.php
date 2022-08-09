<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('twitch_stream_id');
            $table->unsignedBigInteger('game_id')->index();
            $table->string('game_name')->index();
            $table->string('title');
            $table->unsignedBigInteger('viewer_count');
            $table->dateTime('started_at');
            $table->json('tag_ids');
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
        Schema::dropIfExists('streams');
    }
};
