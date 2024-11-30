<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// only for test
use App\Models\Event;
// end

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $events = Event::with('users')->get();
    
    return view('dashboard',compact('events'));

    // return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
