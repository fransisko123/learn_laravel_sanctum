<?php

use App\Http\Controllers\TestQueueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-queue', [TestQueueController::class, 'index']);
Route::post('/test-queue', [TestQueueController::class, 'sendMail'])->name('test_queue.post');
