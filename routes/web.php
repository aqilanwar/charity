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
//Front View Controller
Route::get('/',[HomeController::class,'Home'])->name('/');
Route::get('/event',[HomeController::class,'ListEvent'])->name('list.event');
Route::get('/event/{id}',[HomeController::class,'ViewEvent']);
Route::get('/donation',[HomeController::class,'Donation'])->name('donation');


// Event Controller
Route::post('/event/add',[EventController::class,'AddEvent'])->name('add.event')->middleware('auth');
Route::get('/manage/event',[EventController::class,'AllEvent'])->name('all.event')->middleware('auth');
Route::get('/event/edit/{id}',[EventController::class,'Edit'])->middleware('auth');
Route::get('/event/edit/deletepic/{id}',[EventController::class,'DeletePic'])->middleware('auth');
Route::post('/event/update/{id}',[EventController::class,'Update'])->middleware('auth');
Route::get('/event/delete/{id}',[EventController::class,'Delete'])->middleware('auth');
Route::get('/event/kick/{id}',[EventController::class,'KickUser'])->middleware('auth');
Route::post('/event/addpic',[EventController::class,'AddPic'])->name('add.pic')->middleware('auth');
Route::get('/manage/user',[UserController::class,'AllUser'])->name('all.user')->middleware('auth');

// Route::get('/dashboard',[EventController::class,'EventJoined'])->name('dashboard')->middleware('auth');


Route::post('/event/join',[EventController::class,'JoinEvent'])->name('join.event');
Route::post('/event/join/cancel',[EventController::class,'JoinCancel'])->name('join.cancel');


Route::get('/manage/user/role/{id}',[UserController::class,'EditRole'])->middleware('auth');
Route::get('/manage/user/delete/{id}',[UserController::class,'DeleteUser'])->middleware('auth');
Route::post('/manage/user/managerole',[UserController::class,'ManageRole'])->name('manage.role')->middleware('auth');
Route::get('/logout',[HomeController::class,'Logout'])->name('logout');

// Route::get('/profile',[HomeController::class,'index'])->middleware('auth');
Route::get('/dashboard',[EventController::class,'EventJoined'])->name('dashboard')->middleware('auth');
Route::get('/manage/user/search',[UserController::class,'SearchUser'])->name('search.user')->middleware('auth');
Route::get('/manage/event/search',[EventController::class,'SearchEvent'])->name('search.event')->middleware('auth');
Route::get('/search/event/',[HomeController::class,'SearchEventFront'])->name('search.event.front');
Route::post('/submit/donation',[HomeController::class,'SubmitDonation'])->name('submit.donation');

