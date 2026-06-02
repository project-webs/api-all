<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TournamentController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Tournament::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tournaments,slug',
            'description' => 'nullable|string',
            'type' => 'required|string|in:single_elimination,double_elimination,round_robin',
            'status' => 'required|string|in:pending,ongoing,finished',
            'third_place_match' => 'boolean',
            'seeded' => 'boolean',
            'participant_count' => 'integer|min:0',
        ]);

        $tournament = Tournament::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Turnamen berhasil dibuat.',
            'data' => $tournament
        ], 201);
    }

    public function show(Tournament $tournament)
    {
        return response()->json([
            'status' => 'success',
            'data' => $tournament
        ]);
    }

    public function update(Request $request, Tournament $tournament)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('tournaments')->ignore($tournament->id),
            ],
            'description' => 'nullable|string',
            'type' => 'required|string|in:single_elimination,double_elimination,round_robin',
            'status' => 'required|string|in:pending,ongoing,finished',
            'third_place_match' => 'boolean',
            'seeded' => 'boolean',
            'participant_count' => 'integer|min:0',
        ]);

        $tournament->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Turnamen berhasil diperbarui.',
            'data' => $tournament
        ]);
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Turnamen berhasil dihapus.'
        ]);
    }
}
