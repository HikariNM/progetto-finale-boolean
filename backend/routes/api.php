<?php

use App\Http\Controllers\Api\AdultApiController;
use App\Http\Controllers\Api\LitterApiController;
use App\Http\Controllers\Api\PuppyApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('adults', [AdultApiController::class, 'index']);
Route::get('adults/{adult}', [AdultApiController::class, 'show']); //The route parameter placeholder must EXACTLY match the controller variable name
Route::get('litters', [LitterApiController::class, 'index']);
Route::get('litters/{litter}', [LitterApiController::class, 'show']);
Route::get('puppies', [PuppyApiController::class, 'index']);
Route::get('puppies/{puppy}', [PuppyApiController::class, 'show']);
