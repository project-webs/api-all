<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'friendly_match_id',
    'game_number',
    'score_player1',
    'score_player2',
    'winner_id'
])]
class FriendlyMatchGame extends Model
{
    public function friendlyMatch(): BelongsTo
    {
        return $this->belongsTo(FriendlyMatch::class);
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }
}
