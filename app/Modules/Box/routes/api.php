<?php

use App\Modules\Box\Http\Controllers\BoxController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'api/boxes',
    'middleware' => ['auth:sanctum'],
], function ($router) {
    Route::post('/add', [BoxController::class,'add']);
});