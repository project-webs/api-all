<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TournamentMatch;
use Illuminate\Http\Request;

class TournamentMatchController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => TournamentMatch::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'round' => 'required|integer|min:1',
            'match_number' => 'required|integer|min:1',
            'bracket' => 'required|string|max:255',
            'participant1_id' => 'nullable|exists:participants,id',
            'participant2_id' => 'nullable|exists:participants,id',
            'winner_id' => 'nullable|exists:participants,id',
            'score1' => 'nullable|integer',
            'score2' => 'nullable|integer',
            'point_history' => 'nullable|array',
            'status' => 'required|string|in:pending,ongoing,finished',
            'is_rating_processed' => 'boolean',
            'next_match_id' => 'nullable|exists:tournament_matches,id',
            'next_match_slot' => 'nullable|boolean',
            'is_bye' => 'boolean',
        ]);

        $match = TournamentMatch::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pertandingan berhasil dibuat.',
            'data' => $match
        ], 201);
    }

    public function show(TournamentMatch $tournamentMatch)
    {
        return response()->json([
            'status' => 'success',
            'data' => $tournamentMatch
        ]);
    }

    public function update(Request $request, TournamentMatch $tournamentMatch)
    {
        $validated = $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'round' => 'required|integer|min:1',
            'match_number' => 'required|integer|min:1',
            'bracket' => 'required|string|max:255',
            'participant1_id' => 'nullable|exists:participants,id',
            'participant2_id' => 'nullable|exists:participants,id',
            'winner_id' => 'nullable|exists:participants,id',
            'score1' => 'nullable|integer',
            'score2' => 'nullable|integer',
            'point_history' => 'nullable|array',
            'status' => 'required|string|in:pending,ongoing,finished',
            'is_rating_processed' => 'boolean',
            'next_match_id' => 'nullable|exists:tournament_matches,id',
            'next_match_slot' => 'nullable|boolean',
            'is_bye' => 'boolean',
        ]);

        $tournamentMatch->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pertandingan berhasil diperbarui.',
            'data' => $tournamentMatch
        ]);
    }

    public function destroy(TournamentMatch $tournamentMatch)
    {
        $tournamentMatch->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pertandingan berhasil dihapus.'
        ]);
    }
}
