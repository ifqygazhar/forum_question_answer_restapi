<?php

use App\Http\Controllers\Api\CreateAnswerController;
use App\Http\Controllers\Api\CreateCommentController;
use App\Http\Controllers\Api\CreateQuestionController;
use App\Http\Controllers\Api\DeleteAnswerController;
use App\Http\Controllers\Api\DeleteCommentController;
use App\Http\Controllers\Api\DeleteQuestionController;
use App\Http\Controllers\Api\DeleteUserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ShowQuestionController;
use App\Http\Controllers\Api\ShowUserQuestionController;
use App\Http\Controllers\Api\UpdateAnswerController;
use App\Http\Controllers\Api\UpdateCommentController;
use App\Http\Controllers\Api\UpdateQuestionController;
use App\Http\Controllers\Api\UpdateUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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


Route::middleware('jwt.verify')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/question/all', ShowQuestionController::class)->name('show.question');
Route::get('/question/{id}/{title}', ShowUserQuestionController::class)->name('show.user.question');

Route::post('/user/register', RegisterController::class)->name('register');
Route::post('/user/login', LoginController::class)->name('login');
Route::get('/user/logout', LogoutController::class)->name('logout')->middleware('jwt.logout');
Route::put('/user/{username}/update/{id}', UpdateUserController::class)->name('update')->middleware('jwt.verify');
Route::delete('/user/{username}/delete/{id}', DeleteUserController::class)->name('delete')->middleware('jwt.verify');

Route::post('/user/{username}/question', CreateQuestionController::class)->name('create.question')->middleware('jwt.verify');
Route::put('/user/{username}/edit/question/{id}', UpdateQuestionController::class)->name('update.question')->middleware('jwt.verify');
Route::delete('/user/{username}/delete/question/{id}', DeleteQuestionController::class)->name('delete.question')->middleware('jwt.verify');

Route::post('/question/{id}/answer/{username}', CreateAnswerController::class)->name('create.answer')->middleware('jwt.verify');
Route::put('/question/edit/{username}/answer/{id}', UpdateAnswerController::class)->name('update.answer')->middleware('jwt.verify');
Route::delete('/question/delete/{username}/answer/{id}', DeleteAnswerController::class)->name('delete.answer')->middleware('jwt.verify');

Route::post('/question/{id}/answer/{id_answer}/comment/{username}', CreateCommentController::class)->name('create.comment')->middleware('jwt.verify');
Route::put('/question/edit/{username}/comment/{id}', UpdateCommentController::class)->name('update.comment')->middleware('jwt.verify');
Route::delete('/question/delete/{username}/comment/{id}', DeleteCommentController::class)->name('delete.comment')->middleware('jwt.verify');

//progress
//Route::post('/email/verification-notification', [\App\Http\Controllers\VerifyEmailController::class,'resendNotification'])->middleware('auth')->name('verification.send');
