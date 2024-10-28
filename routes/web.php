<?php

use App\Models\Patient;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get(
  'patients/trash/{id}',
  [PatientController::class, 'trash'])
  ->name('patients.trash');

Route::get(
  'patients/trashed',
  [PatientController::class, 'trashed'])
  ->name('patients.trashed');

Route::get(
  'patients/restore/{id}',
  [PatientController::class, 'trash'])
  ->name('patients.restore');

Route::resource('patients', PatientController::class);


