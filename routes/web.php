<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource("users", UserController::class)->middleware("auth");

Route::get("login", [AuthController::class, "login"])->name("users.login");

Route::post("authenticate", [AuthController::class, "authenticate"])->name("users.auth");

Route::get("create", [AuthController::class, "create"])->name("users.create");

Route::post("store", [AuthController::class, "store"])->name("users.store");

Route::get("logout", [AuthController::class, "logout"])->name("users.logout");
