<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\ScannerController;


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

Route::get('/nuevo/servicio/', function () {
    return view('admin.servicios.create');
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

    // =============== M O D U L O   C L I E N T S ===============================
    Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients/create', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
    Route::patch('/clients/update/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/delete/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('clients.destroy');

    // =============== M O D U L O  T A L L E R ===============================
    Route::post('/producto', [App\Http\Controllers\TallerController::class, 'store_product'])->name('product.store_product');


    Route::get('/admin/taller', [App\Http\Controllers\TallerController::class, 'index'])->name('taller.index');
    Route::get('/admin/taller/create', [App\Http\Controllers\TallerController::class, 'create'])->name('taller.create');
    Route::post('/admin/taller/store', [App\Http\Controllers\TallerController::class, 'store'])->name('taller.store');
    Route::get('/admin/taller/edit/{id}', [App\Http\Controllers\TallerController::class, 'edit'])->name('taller.edit');
    Route::patch('/admin/taller/update/{id}', [App\Http\Controllers\TallerController::class, 'update'])->name('taller.update');
    Route::patch('/admin/taller/status/{id}', [App\Http\Controllers\TallerController::class, 'edit_status'])->name('taller.edit_status');
    Route::delete('/admin/taller/delete/{id}', [App\Http\Controllers\TallerController::class, 'destroy'])->name('taller.destroy');

    Route::get('/imprimir_etiqueta/{id}', [App\Http\Controllers\TallerController::class, 'imprimir'])->name('imprimir.create');

    /*|--------------------------------------------------------------------------
    |Scanner
    |--------------------------------------------------------------------------*/

    Route::get('scanner_servicios', [App\Http\Controllers\ScannerController::class, 'index'])->name('scanner.index');
    Route::get('scanner_productos', [App\Http\Controllers\ScannerController::class, 'index_products'])->name('scanner_products.index');

    Route::get('scanner/search', [App\Http\Controllers\ScannerController::class, 'search'])->name('scanner.search');
    Route::get('scanner/search/product', [App\Http\Controllers\ScannerController::class, 'search_product'])->name('scanner_product.search');


    /*|--------------------------------------------------------------------------
    |Configuracion
    |--------------------------------------------------------------------------*/
    Route::get('/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
    Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');
});
Route::get('/taller/view/{id}', [App\Http\Controllers\TallerController::class, 'show'])->name('taller.show');

