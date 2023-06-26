<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisibilityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return redirect()->action([HouseController::class, 'index']);;
        });
        Route::resource('houses', HouseController::class)->names([
            'index' => 'welcome',
            'create' => 'houses.create',
            'show' => 'houses.show'
        ]);

        Route::put('/houses/{house}', [MessageController::class, 'update'])->name('messages.update');

        Route::delete('/message/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

        Route::post('/visibility/{house}', [VisibilityController::class, 'index'])->name('visibility.index');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
