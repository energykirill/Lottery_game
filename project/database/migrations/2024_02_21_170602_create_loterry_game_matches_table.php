<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lottery_game_matches', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->date('start_date');
            $table->time('start_time');
            $table->integer('winner_id')->nullable();
            $table->boolean('is_finished')->default(false);

            $table->foreign('game_id')->references('id')->on('lottery_games')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_game_matches');
    }
};
