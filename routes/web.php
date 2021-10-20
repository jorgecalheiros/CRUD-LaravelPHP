<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
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

Route::redirect("/", "/posts");

Route::resource("users", UserController::class, [
    'only' => ['index', 'show', 'edit', 'update', 'destroy']
])->middleware("auth");

Route::get("login", [AuthController::class, "login"])->name("auth.login");

Route::post("authenticate", [AuthController::class, "authenticate"])->name("auth.auth");

Route::get("create", [AuthController::class, "create"])->name("auth.create");

Route::post("store", [AuthController::class, "store"])->name("auth.store");

Route::get("logout", [AuthController::class, "logout"])->name("auth.logout");

Route::resource("posts", PostController::class)->middleware("auth");

Route::prefix("system")->group(function () {
    Route::post("language_switch", [LangController::class, "changeLang"])->name("system.lang.switch");

    Route::view('admin/settings/manage-users', 'pages.settings.manage-users')->name('system.admin.settings.manage-users');
    Route::post('admin/settings/import-users', [SettingController::class, 'importUsers'])->name('system.admin.settings.import-users');
    Route::get('admin/settings/export-users', [SettingController::class, 'exportUsers'])->name('system.admin.settings.export-users');
});

Route::prefix("admin")->group(function () {
    Route::view("/", "pages.admin.index")->name("admin.index");
    Route::get("/users", [UserController::class, "index"])->name("admin.users");
    Route::view("/settings/manage-users", "pages.settings.manage-users")->name("admin.import-export");
    Route::post('/settings/import-users', [SettingController::class, 'importUsers'])->name('admin.import-users');
    Route::get('/settings/export-users', [SettingController::class, 'exportUsers'])->name('admin.export-users');
});
