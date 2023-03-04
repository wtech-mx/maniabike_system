<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermisosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/show/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::patch('/roles/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/delete/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('destroy.roles');

    Route::resource('permisos', PermisosController::class);
    Route::resource('users', UserController::class);

    // =============== M O D U L O   C U R S O S ===============================
    Route::get('/admin/cursos', [App\Http\Controllers\CursosController::class, 'index'])->name('cursos.index');
    Route::get('/admin/cursos/store', [App\Http\Controllers\CursosController::class, 'create'])->name('cursos.create');
    Route::post('/admin/cursos/create', [App\Http\Controllers\CursosController::class, 'store'])->name('cursos.store');
    Route::get('/admin/cursos/edit/{id}', [App\Http\Controllers\CursosController::class, 'edit'])->name('cursos.edit');
    Route::patch('/admin/cursos/update/{id}', [App\Http\Controllers\CursosController::class, 'update'])->name('cursos.update');
    Route::delete('/admin/cursos/delete/{id}', [App\Http\Controllers\CursosController::class, 'destroy'])->name('cursos.destroy');

    /*|--------------------------------------------------------------------------
    |Configuracion
    |--------------------------------------------------------------------------*/
    Route::get('/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
    Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');

});

