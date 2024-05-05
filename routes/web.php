<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminTaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserTaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('loginpost');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware'=>['auth','admin']], function () {
    Route::get('', function () {
        return view('admin.index');
    })->name('index');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('', function () {
            return view('admin.user.list');
        })->name('index');
        Route::get('list',[AdminUserController::class,'list'])->name('list');
        Route::get('create', function () {
            return view('admin.user.form');
        })->name('create');
        Route::post('store', [AdminUserController::class, 'store'])->name('store');
    });
    Route::group(['prefix' => 'task', 'as' => 'task.'], function () {
        Route::get('', function () {
            return view('admin.task.list');
        })->name('index');
        Route::get('list',[AdminTaskController::class,'list'])->name('list');
        Route::get('create', function () {
            return view('admin.task.form');
        })->name('create');
        Route::post('store', [AdminTaskController::class, 'store'])->name('store');
    });
});

Route::group(['prefix' => 'user', 'as' => 'user.','middleware'=>['auth','user']], function () {
    Route::get('', function () {
        return view('user.index');
    })->name('index');

    Route::group(['prefix' => 'task', 'as' => 'task.'], function () {
        Route::get('', function () {
            return view('user.task.list');
        })->name('index');
        Route::get('list',[UserTaskController::class,'list'])->name('list');
        Route::get('grafik',[UserTaskController::class,'grafik'])->name('grafik');
        Route::get('notification',[UserTaskController::class,'notification'])->name('notification');
        Route::get('create', function () {
            return view('user.task.form');
        })->name('create');
        Route::get('edit/{id}',[UserTaskController::class,'edit'])->name('edit');
        Route::get('delete/{id}',[UserTaskController::class,'destroy'])->name('delete');
        Route::post('update',[UserTaskController::class,'update'])->name('update');
        Route::post('store', [UserTaskController::class, 'store'])->name('store');
    });
});
