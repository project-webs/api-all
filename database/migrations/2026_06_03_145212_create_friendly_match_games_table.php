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
        Schema::create('friendly_match_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('friendly_match_id')->constrained('friendly_matches')->onDelete('cascade');
            $table->integer('game_number');
            $table->integer('score_player1')->default(0);
            $table->integer('score_player2')->default(0);
            $table->foreignId('winner_id')->nullable()->constrained('players')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendly_match_games');
    }
};
