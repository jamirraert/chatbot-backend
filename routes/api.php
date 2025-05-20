<?php

use App\Events\MessageSent;
use GuzzleHttp\Psr7\Message;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/reverb-test', function(Request $request) {
    event(new MessageSent($request->input('message')));
    return response()->json([
        'Message' => 'broacasted!'
    ]);
});

Route::post('/message', [ChatController::class, 'message']);

Route::post('/typing', [ChatController::class, 'typing']);
