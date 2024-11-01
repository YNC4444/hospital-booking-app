<?php

// use App\Models\Patient;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ServiceController;
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

Route::get(
  'providers/trash/{id}',
  [ProviderController::class, 'trash'])
  ->name('providers.trash');

Route::get(
  'providers/trashed',
  [ProviderController::class, 'trashed'])
  ->name('providers.trashed');

Route::get(
  'providers/restore/{id}',
  [ProviderController::class, 'trash'])
  ->name('providers.restore');

Route::resource('patients', PatientController::class);
Route::resource('providers', ProviderController::class);
Route::resource('services', ServiceController::class);


