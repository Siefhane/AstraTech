<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
route::resource('employee', EmployeeController::class );
//route::get('/Create',[EmployeeController::class ,'create'])->name('employee.create');
route::post('employee-import',[EmployeeController::class ,'import'])->name('employee.import');
route::get('employee-export',[EmployeeController::class ,'export'])->name('employee.export');