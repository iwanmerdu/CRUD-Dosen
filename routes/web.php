<?php

use Illuminate\Support\Facades\Route;



// kode untuk panggil halaman input data
Route::resource('/dosen', \App\Http\Controllers\Dosen\DosenController::class);

