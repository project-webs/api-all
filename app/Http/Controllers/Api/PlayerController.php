<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Player::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:100',
            'division' => 'nullable|string|max:50',
            'itr_rating' => 'integer|min:0',
        ]);

        $player = Player::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pemain berhasil dibuat.',
            'data' => $player
        ], 201);
    }

    public function show(Player $player)
    {
        return response()->json([
            'status' => 'success',
            'data' => $player
        ]);
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:100',
            'division' => 'nullable|string|max:50',
            'itr_rating' => 'integer|min:0',
        ]);

        $player->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pemain berhasil diperbarui.',
            'data' => $player
        ]);
    }

    public function destroy(Player $player)
    {
        $player->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pemain berhasil dihapus.'
        ]);
    }
}
