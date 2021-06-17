<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgramareController;
use App\Http\Controllers\DentistController;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::middleware(['cors'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get("/users/email/{email}", [UserController::class, 'userDetail'])->name('users.userDetail');
    Route::get('/users/{name}', [UserController::class, 'show'])->name('users.show');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::post("/login", [UserController::class, 'login'])->name('users.login');

    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::post("/users/changeUser", [UserController::class, "changeUser"])->name("users.changeUser");

    /*
    Route::view('/{path?}', 'app');
    Route::post("/api/login", [LoginController::class, "login"])->name("api.login");
    Route::post("/api/medic", [MedicController::class, "getMedic"])->name("api.getMedic");
    Route::post("/api/register", [RegisterController::class, "register"])->name("api.register");
    Route::post("/api/user/postUser", [UserController::class, "postUser"])->name("api.postUser");
    Route::post("/api/user/getUser", [UserController::class, "getUser"])->name("api.getUser");
    */

    Route::post("/programare", [ProgramareController::class, "store"])->name("programares.store");
    Route::get("/programare", [ProgramareController::class, "index"])->name("programares.index");

    Route::get("/programariByDentistID", [ProgramareController::class, "getByDentistID"]);

    Route::post("/dentist", [DentistController::class, "store"])->name("dentists.store");
    Route::get("/dentist", [DentistController::class, "index"])->name("dentists.index");
});