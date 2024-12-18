<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\AdminController;

Route::get('/mainform', function () {
    return view('/mainform');
});

Route::post('/mainform', [FormController::class, 'submit']);

Route::get('/admin', function () {
    return view('admin');
});

Route::post('/admin', [AdminController::class, 'login']);

Route::get('/panel', [AdminController::class, 'showPanel'])->name('panel');

Route::get('/search', [AdminController::class, 'search'])->name('search');

Route::get('export-form-submissions', [AdminController::class, 'export'])->name('export.form_submissions');

Route::get('/a_register', function () {
    return view('a_register');
});

Route::post('/a_register', [AdminController::class, 'register']);

Route::post('/update-status', [AdminController::class, 'updateStatus'])->name('update.status');
