<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('dashboard', [CustomAuthController::class, 'show'])->name('dashboard');
Route::get('login', [CustomAuthController::class, 'index','show'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('/listofuser', [CustomAuthController::class,'user']);
Route::get('edit-user/{id}', [CustomAuthController::class, 'edit'])->name('user.edit');
Route::post('update-user/{id}', [CustomAuthController::class, 'update'])->name('user.update');
Route::delete('delete-user/{id}', [CustomAuthController::class, 'delete'])->name('user.delete');
Route::get('xss', [CustomAuthController::class, 'xss']);






