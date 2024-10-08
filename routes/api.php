<?php

use App\Http\Controllers\Api\EvaluationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('evaluations/{company}', [EvaluationController::class, 'index']);
Route::post('evaluations/{company}', [EvaluationController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function() {
    return response()->json(['status' => 'success', 'message' => 'API Micro 02 - Avaliações']);
});

