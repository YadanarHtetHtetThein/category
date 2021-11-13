<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminCheckMiddleware;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if(Auth::check()){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin#index');
        }else{
            return back();
        }
    }   
})->name('dashboard');

Route::group(['prefix'=>'admin','middleware'=>[AdminCheckMiddleware::class]],function(){
    Route::get('categories',[CategoryController::class, 'index'])->name('admin#index');
    Route::get('categories/create',[CategoryController::class, 'create'])->name('admin#create');
    Route::post('categories/create', [CategoryController::class, 'store'])->name('admin#store');
    Route::get('categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin#destory');
    Route::get('categories/update/{id}', [CategoryController::class, 'edit'])->name('admin#edit');
    Route::post('categories/update/{id}', [CategoryController::class, 'update'])->name('admin#update');
    Route::get('categories/publish/{id}', [CategoryController::class, 'publish'])->name('admin#publish');
});
