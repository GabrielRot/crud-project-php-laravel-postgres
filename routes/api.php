<?php
  
  use App\Http\Controllers\AuthController;
  use App\Http\Controllers\ProdutoController;
  use Illuminate\Support\Facades\Route;

  Route::post('login', [AuthController::class, 'login']);
  
  Route::middleware('jwt.auth')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('produtos', [ProdutoController::class, 'index']);
    Route::get('produtos/{id}', [ProdutoController::class, 'show']);
    Route::post('produtos', [ProdutoController::class, 'store']);
    Route::put('produtos/{id}', [ProdutoController::class, 'update']);
    Route::delete('produtos/{id}', [ProdutoController::class, 'destroy']);
  });
