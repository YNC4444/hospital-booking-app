<?php

// use App\Models\Patient;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ---------------patients
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

// -------------providers
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

// -------------- schedules
Route::get(
  'schedules/trash/{id}',
  [ScheduleController::class, 'trash'])
  ->name('schedules.trash');

Route::get(
  'schedules/trashed',
  [ScheduleController::class, 'trashed'])
  ->name('schedules.trashed');

Route::get(
  'schedules/restore/{id}',
  [ScheduleController::class, 'trash'])
  ->name('schedules.restore');

// -------------- appointments
Route::get(
  'appointments/trash/{id}',
  [AppointmentController::class, 'trash'])
  ->name('appointments.trash');

Route::get(
  'appointments/trashed',
  [AppointmentController::class, 'trashed'])
  ->name('appointments.trashed');

Route::get(
  'appointments/restore/{id}',
  [AppointmentController::class, 'trash'])
  ->name('appointments.restore');

Route::get(
  '/api/schedules', 
  [ScheduleController::class, 'getSchedulesByDate']);

Route::get(
  '/api/schedules/{schedule}/times', 
  [ScheduleController::class, 'getAvailableTimes']);

Route::resource('patients', PatientController::class);
Route::resource('providers', ProviderController::class);
Route::resource('services', ServiceController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('appointments', AppointmentController::class);


