<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\AlunoControlle

Route::post('/login', function (Request $resquest){
    $credentials = $request->only('email', 'password');

    if (auth::attemp($credentials)){
        $user = $request->user();

        $token = $user->create_token('auth_token')->plainTextToken;

        return response()->json([
            "access_token" => $token,
            "token_type" => 'Bearer'
        ]);
    }

    return response()->json([
        "message" => "usuario invalido"
    ]);

    $token = $user->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];

})
Route::post('/register', function(Request $request){
    $request->validate([
        "email" => "required|string|email|unique:users",
        "name" => "required|string",
        "password" => "required|string|min:8"
    ]);

    $user = User::create([
        "email" => $resquest->email,
        "name" => $request->name,
        "password" => Hash::make($request->password)
    ]);

    return request()->json([
        "message" => "sucesso",
        "user" => $user
    ]);
})


Route::apiResource('professores', ProfessoresController::class);
Route::apiResource('cursos', CursosController::class);
Route::apiResource('alunos', AlunoController::class);
