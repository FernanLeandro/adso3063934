<?php

use App\Http\Controllers\API\PetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

//Endpoint http://127.0.0.1:8000/api/login
Route::post('login', [AuthController::class, 'login']);

//Endpoint http://127.0.0.1:8000/api/logout
Route::post('logout', [AuthController::class, 'logout']);

//Rutas protegidas
//Endpoint http://127.0.0.1:8000/api/pets/list
Route::get('pets/list', function () {
    $token = request()->bearerToken();
    if (!$token || !cache()->get('api_token_' . $token)) {
        return response()->json(['message' => 'Token no proporcionado'], 401);
    }
    return app(PetController::class)->index();
});

//Endpoint http://127.0.0.1:8000/api/pets/show/{id}
Route::get('pets/show/{id}', function ($id) {
    $token = request()->bearerToken();
    if (!$token || !cache()->get('api_token_' . $token)) {
        return response()->json(['message' => 'Token no proporcionado'], 401);
    }
    $controller = app(PetController::class);
    return $controller->show($id);
});

//Endpoint http://127.0.0.1:8000/api/pets/store
Route::post('pets/store', function () {
    $token = request()->bearerToken();
    if (!$token || !cache()->get('api_token_' . $token)) {
        return response()->json(['message' => 'Token no proporcionado'], 401);
    }
    return app(PetController::class)->store(request());
});

//Endpoint http://127.0.0.1:8000/api/pets/edit/{id}
Route::put('pets/edit/{id}', function ($id) {
    $token = request()->bearerToken();
    if (!$token || !cache()->get('api_token_' . $token)) {
        return response()->json(['message' => 'Token no proporcionado'], 401);
    }
    $controller = app(PetController::class);
    return $controller->update(request(), $id);
});

//Endpoint http://127.0.0.1:8000/api/pets/delete/{id}
Route::delete('pets/delete/{id}', function ($id) {
    $token = request()->bearerToken();
    if (!$token || !cache()->get('api_token_' . $token)) {
        return response()->json(['message' => 'Token no proporcionado'], 401);
    }
    $controller = app(PetController::class);
    return $controller->destroy($id);
});