<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CarouseController;
use App\Http\Controllers\ContactDetailsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FacilitieController;
use App\Http\Controllers\facilitiesController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TeamDetailsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserQueryController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


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

    Route::get('/carousel', [CarouseController::class, 'index'])->name('carousel.index');
    Route::post('/carousel/upload', [CarouseController::class, 'store'])->name('carousel.store');
    // Delete route for the team member
    Route::delete('/carousel/{id}', [CarouseController::class, 'destroy'])->name('carousel.destroy');

    // Route to toggle active/inactive status
    Route::patch('/carousel/{id}/toggle-status', [CarouseController::class, 'toggleStatus'])->name('carousel.toggleStatus');

    // feature and facility
    Route::get('/features', [FeaturesController::class, 'index'])->name('features.index');
    Route::post('/features/store', [FeaturesController::class, 'store'])->name('features.store');
    Route::delete('/features/store/{id}', [FeaturesController::class, 'destory'])->name('feature.destory');

    Route::post('/facilities/store', [FacilitieController::class, 'store'])->name('facilities.store');

    Route::delete('/facilities/delete/{id}',[FacilitieController::class,'destory'])->name('facilities.destory');
    Route::put('/facilities/update/{id}',[FacilitieController::class,'update'])->name('facilities.update');

    //rooms 
    Route::get('/rooms/management',[RoomsController::class,'index'])->name('rooms.index');
    Route::post('/rooms/add',[RoomsController::class,'store'])->name('rooms.store');
    Route::put('/rooms/edit/{id}',[RoomsController::class,'update'])->name('rooms.update');
    Route::put('/room/room/toggle/{id}', [RoomsController::class, 'roomtoggleStatus'])->name('rooms.toggale');

    Route::post('/room/image/uploade/{id}',[RoomsController::class,'imgStore'])->name('room.image.store');
    Route::delete('/room/image/{id}', [RoomsController::class, 'imgDelete'])->name('room.image.delete');
    Route::put('/room/image/toggle-status/{id}', [RoomsController::class, 'toggleStatus'])->name('room.image.toggleStatus');

    Route::delete('/rooms/{room}', [RoomsController::class, 'destroy'])->name('rooms.destroy');


    //user query
    Route::get('user/query',[UserQueryController::class,'index'])->name('user.query.index');
    Route::delete('/user/query/delete/{id}',[UserQueryController::class,'destory'])->name('user.query.delete');

});

require __DIR__ . '/auth.php';


Route::get('/',[WelcomeController::class,'index'])->name('welcome');
Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
Route::get('rooms/details/{id}',[RoomController::class,'showroom'])->name('rooms.details');
Route::get('/facilities', [facilitiesController::class, 'index'])->name('facilities.index');
Route::get('/contact', [ContactUsController::class, 'index'])->name('contact.index');
Route::post('/user/query/store',[UserQueryController::class,'store'])->name('user.query.store');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');


Route::middleware('auth')->group(function (){
    Route::get('user/profile',[UserProfileController::class,'index'])->name('user.profile');
});