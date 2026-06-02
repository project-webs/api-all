<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $income = Transaction::where('type', 'income')->sum('amount');
        $expense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $income - $expense;

        return response()->json([
            'status' => 'success',
            'summary' => [
                'total_income' => (int) $income,
                'total_expense' => (int) $expense,
                'current_balance' => (int) $balance,
            ],
            'data' => Transaction::orderBy('date', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $transaction = Transaction::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi kas berhasil dicatat.',
            'data' => $transaction
        ], 201);
    }

    public function show(Transaction $transaction)
    {
        return response()->json([
            'status' => 'success',
            'data' => $transaction
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $transaction->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi kas berhasil diperbarui.',
            'data' => $transaction
        ]);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi kas berhasil dihapus.'
        ]);
    }
}
