<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});


// Event Controller
Route::post('/event/add',[EventController::class,'AddEvent'])->name('add.event')->middleware('auth');
Route::get('/event/all',[EventController::class,'AllEvent'])->name('all.event')->middleware('auth');
Route::get('/event/edit/{id}',[EventController::class,'Edit'])->middleware('auth');
Route::get('/event/edit/deletepic/{id}',[EventController::class,'DeletePic'])->middleware('auth');
Route::post('/event/update/{id}',[EventController::class,'Update'])->middleware('auth');
Route::get('/event/delete/{id}',[EventController::class,'Delete'])->middleware('auth');
Route::post('/event/addpic',[EventController::class,'AddPic'])->name('add.pic')->middleware('auth');
Route::get('/manage/user',[UserController::class,'AllUser'])->name('all.user')->middleware('auth');

Route::get('/manage/user/role/{id}',[UserController::class,'EditRole'])->middleware('auth');
Route::get('/event/user/delete/{id}',[EventController::class,'DeleteUser'])->middleware('auth');

Route::get('/profile',[HomeController::class,'index'])->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');
