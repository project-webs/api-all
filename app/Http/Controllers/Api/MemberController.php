<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Member::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'member_number' => 'required|string|unique:members',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'joined_at' => 'nullable|date',
        ]);

        if (empty($validated['joined_at'])) {
            $validated['joined_at'] = now()->format('Y-m-d');
        }

        $member = Member::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Anggota berhasil dibuat.',
            'data' => $member
        ], 201);
    }

    public function show(Member $member)
    {
        return response()->json([
            'status' => 'success',
            'data' => $member
        ]);
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'member_number' => [
                'required',
                'string',
                Rule::unique('members')->ignore($member->id),
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'joined_at' => 'required|date',
        ]);

        $member->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Anggota berhasil diperbarui.',
            'data' => $member
        ]);
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Anggota berhasil dihapus.'
        ]);
    }
}
