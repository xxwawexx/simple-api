<?php

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Show all contacts
Route::get('contacts', [ContactController::class, 'index']);

//Show single contact
Route::get('contact/{id}', [ContactController::class, 'show']);

//Create new contact
Route::post('contact', [ContactController::class, 'store']);

//Update contact
Route::put('contact/{id}', [ContactController::class, 'update']);

//Delete contact
Route::delete('contact/{id}', [ContactController::class, 'destroy']);
