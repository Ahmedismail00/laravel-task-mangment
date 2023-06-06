<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', function (){
 return view('welcome');
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::Resource('task', TaskController::class)->middleware('auth');
    Route::Resource('project', ProjectController::class)->middleware('auth');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
