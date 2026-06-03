<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FriendlyMatchGame;
use Illuminate\Http\Request;

class FriendlyMatchGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FriendlyMatchGame::with(['friendlyMatch', 'winner']);
        if ($request->has('friendly_match_id')) {
            $query->where('friendly_match_id', $request->friendly_match_id);
        }
        return response()->json($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'friendly_match_id' => 'required|exists:friendly_matches,id',
            'game_number' => 'required|integer',
            'score_player1' => 'sometimes|integer',
            'score_player2' => 'sometimes|integer',
            'winner_id' => 'nullable|exists:players,id',
        ]);

        $friendlyMatchGame = FriendlyMatchGame::create($validated);
        return response()->json($friendlyMatchGame, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FriendlyMatchGame $friendlyMatchGame)
    {
        $friendlyMatchGame->load(['friendlyMatch', 'winner']);
        return response()->json($friendlyMatchGame);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FriendlyMatchGame $friendlyMatchGame)
    {
        $validated = $request->validate([
            'friendly_match_id' => 'sometimes|exists:friendly_matches,id',
            'game_number' => 'sometimes|integer',
            'score_player1' => 'sometimes|integer',
            'score_player2' => 'sometimes|integer',
            'winner_id' => 'nullable|exists:players,id',
        ]);

        $friendlyMatchGame->update($validated);
        return response()->json($friendlyMatchGame);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FriendlyMatchGame $friendlyMatchGame)
    {
        $friendlyMatchGame->delete();
        return response()->json(null, 204);
    }
}
