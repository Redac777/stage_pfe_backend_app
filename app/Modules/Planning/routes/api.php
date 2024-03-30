<?php

use App\Modules\Planning\Http\Controllers\PlanningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'api/plannings',
    'middleware' => ['auth:sanctum'],
], function ($router) {
    Route::post('/add', [PlanningController::class,'add']);
});