<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PlatoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComandaController;
use App\Http\Livewire\ReportesController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/home-dashboard', [HomeController::class, 'index'])->middleware('auth')->name('home-dashboard');

Route::get('report/pdf/{user}/{type}/{f1}/{f2}', [ReportController::class, 'reportePDF'])->name('reporte.pdf');
//Route::get('report/pdf/{user}/{type}', [ReportController::class, 'reportePDF'])->name('reporte.pdf');


Route::resource('menu', MenuController::class)->names('menu')->middleware('auth');
Route::post('/menu/guardar',[MenuController::class,'guardar']);
Route::post('/menu/creater',[MenuController::class,'creater']);
Route::get('/menu/listar',[MenuController::class,'show']);
Route::get('menu/pdf/{menu}', [MenuController::class, 'pdf'])->name('menu.pdf');


Route::resource('plato', PlatoController::class)->names('plato')->middleware('auth');
Route::resource('cliente', ClienteController::class)->names('cliente')->middleware('auth');
Route::resource('categoria', CategoriaController::class)->except('show')->names('categoria');
Route::resource('comanda', ComandaController::class)->names('comanda')->middleware('auth');
Route::get('cambio_de_estado/comandas/{comanda}', [ComandaController::class, 'cambio_de_estado'])->name('cambio.estado.comanda');
Route::get('comandas/pdf/{comanda}', [ComandaController::class, 'pdf'])->name('comandas.pdf');


Route::get('comanda/pdf/{comanda}', [ComandaController::class, 'pdf'])->name('comanda.pdf');

Route::get('reports', ReportesController::class)->middleware('auth')->name('reports.reportes');

Route::get('cliente.listvip', [ClienteController::class, 'listvip'])->name('cliente.listvip');

Route::get('cliente.listcumple', [ClienteController::class, 'listcumple'])->name('cliente.listcumple');

Route::get('notifications/get',[ClienteController::class, 'getNotificationsData'])->name('notifications.get');