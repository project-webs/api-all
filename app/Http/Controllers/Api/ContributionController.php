<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Contribution::with('member')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'period' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'nullable|date',
            'status' => 'required|in:paid,unpaid',
            'notes' => 'nullable|string',
        ]);

        $contribution = Contribution::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Iuran berhasil dibuat.',
            'data' => $contribution->load('member')
        ], 201);
    }

    public function show(Contribution $contribution)
    {
        return response()->json([
            'status' => 'success',
            'data' => $contribution->load('member')
        ]);
    }

    public function update(Request $request, Contribution $contribution)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'period' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'nullable|date',
            'status' => 'required|in:paid,unpaid',
            'notes' => 'nullable|string',
        ]);

        $contribution->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Iuran berhasil diperbarui.',
            'data' => $contribution->load('member')
        ]);
    }

    public function destroy(Contribution $contribution)
    {
        $contribution->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Iuran berhasil dihapus.'
        ]);
    }
}
