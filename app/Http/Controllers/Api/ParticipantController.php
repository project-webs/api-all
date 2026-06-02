<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Participant::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'player_id' => 'nullable|exists:players,id',
            'name' => 'required|string|max:255',
            'seed' => 'nullable|integer|min:1',
        ]);

        $participant = Participant::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Partisipan berhasil dibuat.',
            'data' => $participant
        ], 201);
    }

    public function show(Participant $participant)
    {
        return response()->json([
            'status' => 'success',
            'data' => $participant
        ]);
    }

    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'player_id' => 'nullable|exists:players,id',
            'name' => 'required|string|max:255',
            'seed' => 'nullable|integer|min:1',
        ]);

        $participant->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Partisipan berhasil diperbarui.',
            'data' => $participant
        ]);
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Partisipan berhasil dihapus.'
        ]);
    }
}
