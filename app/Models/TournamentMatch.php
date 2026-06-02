<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'tournament_id',
    'round',
    'match_number',
    'bracket',
    'participant1_id',
    'participant2_id',
    'winner_id',
    'score1',
    'score2',
    'status',
    'next_match_id',
    'next_match_slot',
    'is_bye',
    'point_history',
    'is_rating_processed'
])]
class TournamentMatch extends Model
{
    protected $table = 'tournament_matches';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'next_match_slot' => 'boolean',
            'is_bye' => 'boolean',
            'point_history' => 'array',
            'is_rating_processed' => 'boolean',
        ];
    }

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function participant1(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'participant1_id');
    }

    public function participant2(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'participant2_id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'winner_id');
    }

    public function nextMatch(): BelongsTo
    {
        return $this->belongsTo(TournamentMatch::class, 'next_match_id');
    }
}
