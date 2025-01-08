<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactDetailsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\facilitiesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TeamDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.setting');
    Route::put('/settings/update', [SettingController::class, 'update'])->name('general.update');
    Route::put('/contact/details', [ContactDetailsController::class, 'update'])->name('contact.details.update');
    Route::post('/team/management', [TeamDetailsController::class, 'store'])->name('team.management.store');
    // Update route for the team member
    Route::put('/team/management/{team}', [TeamDetailsController::class, 'update'])->name('team.management.update');

    // Delete route for the team member
    Route::delete('/team/management/{team}', [TeamDetailsController::class, 'destroy'])->name('team.management.destroy');

    // Route to toggle active/inactive status
    Route::patch('/team/management/{team}/toggle-status', [TeamDetailsController::class, 'toggleStatus'])->name('team.management.toggleStatus');
});

require __DIR__ . '/auth.php';



Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
Route::get('/facilities', [facilitiesController::class, 'index'])->name('facilities.index');
Route::get('/contact', [ContactUsController::class, 'index'])->name('contact.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
