<?php

use App\Models\Pet;
use App\Http\Controllers\API\PetController;
use Illuminate\Support\Facades\Route;

//Endpoint http://127.0.0.1:8000/api/pets/list
Route::get('pets/list', [PetController::class, 'index']);

//Endpoint http://127.0.0.1:8000/api/pets/show/{id}
Route::get('pets/show/{id}', [PetController::class, 'show']);

//Endpoint http://127.0.0.1:8000/api/pets/store
Route::get('pets/store', [PetController::class, 'store']);

//Endpoint http://127.0.0.1:8000/api/pets/edit/{id}
Route::get('pets/edit/{id}', [PetController::class, 'update']);

//Endpoint http://127.0.0.1:8000/api/pets/delete/{id}
Route::get('pets/delete/{id}', [PetController::class, 'destroy']);