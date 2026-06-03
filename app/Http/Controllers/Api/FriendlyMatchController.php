<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FriendlyMatch;
use Illuminate\Http\Request;

class FriendlyMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matches = FriendlyMatch::with(['player1', 'player2', 'winner'])->get();
        return response()->json($matches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'player1_id' => 'required|exists:players,id',
            'player2_id' => 'required|exists:players,id',
            'match_date' => 'required|date',
            'status' => 'sometimes|string',
            'score_player1' => 'sometimes|integer',
            'score_player2' => 'sometimes|integer',
            'winner_id' => 'nullable|exists:players,id',
        ]);

        $friendlyMatch = FriendlyMatch::create($validated);
        return response()->json($friendlyMatch, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FriendlyMatch $friendlyMatch)
    {
        $friendlyMatch->load(['player1', 'player2', 'winner', 'games']);
        return response()->json($friendlyMatch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FriendlyMatch $friendlyMatch)
    {
        $validated = $request->validate([
            'player1_id' => 'sometimes|exists:players,id',
            'player2_id' => 'sometimes|exists:players,id',
            'match_date' => 'sometimes|date',
            'status' => 'sometimes|string',
            'score_player1' => 'sometimes|integer',
            'score_player2' => 'sometimes|integer',
            'winner_id' => 'nullable|exists:players,id',
        ]);

        $friendlyMatch->update($validated);
        return response()->json($friendlyMatch);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FriendlyMatch $friendlyMatch)
    {
        $friendlyMatch->delete();
        return response()->json(null, 204);
    }
}
