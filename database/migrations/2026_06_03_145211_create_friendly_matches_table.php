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
        Schema::create('friendly_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player1_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('player2_id')->constrained('players')->onDelete('cascade');
            $table->date('match_date');
            $table->string('status')->default('scheduled'); // scheduled, ongoing, completed, cancelled
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
        Schema::dropIfExists('friendly_matches');
    }
};
