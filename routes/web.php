<?php

use App\Http\Controllers\admin\orderController as AdminOrderController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\WatchlistController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

    Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('producer/home', [App\Http\Controllers\HomeController::class, 'indexP'])->name('homeP');
    Route::get('/',[App\Http\Controllers\frontend\frontendController::class,'index'])->name('showSite');
Route::prefix('/admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::resource('/companies',App\Http\Controllers\admin\CompanyController::class)->parameters(['companies'=>'id']);
    Route::resource('/projects',App\Http\Controllers\admin\ProjectController::class)->parameters(['projects'=>'id']);
    Route::resource('/settings',App\Http\Controllers\admin\SettingController::class)->parameters(['settings'=>'id']);
    Route::resource('/users',App\Http\Controllers\admin\userController::class)->parameters(['users'=>'id']);
    Route::resource('/categories',App\Http\Controllers\admin\CategoryController::class)->parameters(['categories'=>'id']);
    Route::resource('/tasks',App\Http\Controllers\admin\TaskController::class)->parameters(['tasks'=>'id']);
    Route::get('order',[App\Http\Controllers\admin\orderController::class,'index'])->name('management');
    Route::get('order/{projectID}', [App\Http\Controllers\admin\orderController::class, 'view'])->name('management_view');
});

Route::middleware(['auth'])->group(function() {
    Route::post('my-project/compelete/{id}', [App\Http\Controllers\frontend\OrderController::class, 'compelete'])->name('project_compelete');
    Route::delete('my-project/cancel/{id}', [App\Http\Controllers\frontend\OrderController::class, 'cancel'])->name('project_cancel');
    Route::resource('watchlist', App\Http\Controllers\frontend\WatchlistController::class)->parameters(['watchlist'=>'id']);
    Route::get('cart', [App\Http\Controllers\frontend\CartController::class, 'index'])->name('cart');
    Route::get('checkout', [App\Http\Controllers\frontend\checkoutController::class, 'index'])->name('checkout');
    Route::get('my-project', [App\Http\Controllers\frontend\OrderController::class, 'index'])->name('my_project');
    Route::get('my-project/{projectID}', [App\Http\Controllers\frontend\OrderController::class, 'view'])->name('project_view');
    Route::get('thankyou', [App\Http\Controllers\frontend\frontendController::class,'thankyou'])->name('thankyou');
    Route::get('Report', [App\Http\Controllers\frontend\frontendController::class,'Report'])->name('Report');
    Route::post('savereport', [App\Http\Controllers\frontend\frontendController::class,'savereport'])->name('savereport');
    Route::get('allreport', [App\Http\Controllers\frontend\frontendController::class,'allreport'])->name('allreport');
    Route::post('allreport/{id}', [App\Http\Controllers\frontend\frontendController::class,'deletereport'])->name('deletereport');
    Route::post('addTask', [App\Http\Controllers\frontend\frontendController::class,'addTask'])->name('addTask');



});



Route::get('/categories',[App\Http\Controllers\frontend\frontendController::class,'categories'])->name('categories');
Route::get('/categories/{category_name}',[App\Http\Controllers\frontend\frontendController::class,'projects'])->name('projects');
Route::get('/categories/{category_name}/{project_name}',[App\Http\Controllers\frontend\frontendController::class,'projectView'])->name('projectView');

Route::prefix('/producer')->middleware(['auth','isAdmin'])->group(function(){
    Route::resource('/producers',App\Http\Controllers\ProducerController::class)->parameters(['producers'=>'id']);
});
