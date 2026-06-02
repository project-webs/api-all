<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ContributionController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TournamentController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\ParticipantController;
use App\Http\Controllers\Api\TournamentMatchController;

// Public Route
Route::get('/', function () {
    return response()->json([
        'name' => 'PTM Batan Indah API',
        'version' => '1.0.0',
        'status' => 'active',
        'endpoints' => [
            'login' => url('/api-ptmbi/login'),
            'logout' => url('/api-ptmbi/logout'),
            'user' => url('/api-ptmbi/user'),
            'users' => url('/api-ptmbi/users'),
            'members' => url('/api-ptmbi/members'),
            'contributions' => url('/api-ptmbi/contributions'),
            'transactions' => url('/api-ptmbi/transactions'),
            'tournaments' => url('/api-ptmbi/tournaments'),
            'players' => url('/api-ptmbi/players'),
            'participants' => url('/api-ptmbi/participants'),
            'tournament-matches' => url('/api-ptmbi/tournament-matches'),
        ]
    ]);
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/members', [MemberController::class, 'index']);
Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/contributions', [ContributionController::class, 'index']);
Route::get('/tournaments', [TournamentController::class, 'index']);
Route::get('/players', [PlayerController::class, 'index']);
Route::get('/participants', [ParticipantController::class, 'index']);
Route::get('/tournament-matches', [TournamentMatchController::class, 'index']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('members', MemberController::class)->except(['index']);
    Route::apiResource('contributions', ContributionController::class)->except(['index']);
    Route::apiResource('transactions', TransactionController::class)->except(['index']);
    Route::apiResource('tournaments', TournamentController::class)->except(['index']);
    Route::apiResource('players', PlayerController::class)->except(['index']);
    Route::apiResource('participants', ParticipantController::class)->except(['index']);
    Route::apiResource('tournament-matches', TournamentMatchController::class)->except(['index']);
});
