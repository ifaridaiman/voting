<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IngestController;
use App\Http\Controllers\VotingController;

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

Route::get('/', [UserController::class,'login'])->name('user.login');
Route::post('/login', [UserController::class,'validation'])->name('user.validation');
Route::get('/user/{name}/update-image', [UserController::class,'update_image'])->name('user.update_image');
Route::put('/update_image_service', [UserController::class,'update_image_service'])->name('user.update_image_service');


Route::get('/register', [IngestController::class,'register'])->name('ingest.register');
Route::post('/ingest', [IngestController::class,'ingest'])->name('ingest.ingest');

Route::get('/vote/king/{user_id}',[VotingController::class,'vote_male'])->name('vote.male');
Route::get('/vote/queen/{user_id}',[VotingController::class,'vote_female'])->name('vote.female');
Route::post('/vote_process',[VotingController::class,'vote_process'])->name('vote.process');
Route::get('/thankyou',[VotingController::class,'thankyou'])->name('vote.thanks');
