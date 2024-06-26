<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ViewfarmController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\PictureController;
use App\Models\Farm;
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
    $farms=Farm::all();
    return view('welcome',compact('farms'));
});
Route::get('/404', function () {
    return view('404');
});

Route::get('/farm/{id}', [ViewfarmController::class, 'farm'])->name('viewfarm');
Route::get('/contact/{id}', [ViewfarmController::class, 'contact'])->name('contact');
Route::get('/product/{id}', [ViewfarmController::class, 'product'])->name('product');
Route::get('/viewqr/{id}', [ViewfarmController::class, 'viewqr'])->name('viewqr');


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
  
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/managuser', [AdminController::class, 'managuser'])->name('admin.managuser');
    Route::post('admin/UpstatusType', [AdminController::class, 'UpstatusType']);
    Route::get('/admin/farm', [AdminController::class, 'farm'])->name('admin.farm');
    Route::get('/admin/addmanager', [AdminController::class, 'addmanager'])->name('admin.addmanager');
    Route::get('autocomplete', [AdminController::class, 'autocomplete'])->name('autocomplete');
    Route::put('/admin/{id}', [FarmController::class, 'managerfarm'])->name('admin.managerfarm');
   
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
    Route::get('/manager/farm', [ManagerController::class, 'farm'])->name('manager.farm');
    Route::get('/manager/addfarm', [ManagerController::class, 'addfarm'])->name('manager.addfarm');
    Route::post('/manager/farmstore', [FarmController::class, 'store'])->name('manager.farmstore');
    Route::get('/manager-viewfarm', [ManagerController::class, 'viewfarm'])->name('manager.viewfarm');
    Route::put('/manager/{id}', [FarmController::class, 'update'])->name('manager.farmupdate');
    Route::get('/manager/users', [ManagerController::class, 'users'])->name('manager.users');
    Route::get('/manager/adduser/{id}', [ManagerController::class, 'adduser'])->name('manager.adduser');
    Route::post('/manager/adduserdb', [StaffController::class, 'store'])->name('manager.adduserdb');
    Route::delete('/staff/{id}/{farm_id}', [StaffController::class,'destroy'])->name('staff.destroy');
    Route::get('/manager/editstaff/{id}', [ManagerController::class, 'edituser'])->name('manager.editstaff');
    Route::put('/manager/staffupdate/{id}', [StaffController::class, 'update'])->name('manager.staffupdate');
    Route::get('/manager/product', [ManagerController::class, 'product'])->name('manager.product');
    Route::get('/manager/addproduct/{id}', [ManagerController::class, 'addproduct'])->name('manager.addproduct');
    Route::post('/manager/addproductdb', [ProductController::class, 'store'])->name('manager.addproductdb');
    Route::post('/manager/upstatus', [ProductController::class, 'upstatus'])->name('upstatus');
    Route::delete('/product/destroy/{id}/{farm_id}', [ProductController::class,'destroy'])->name('product.destroy');
    Route::get('/manager/lot', [ManagerController::class, 'lot'])->name('manager.lot');
    Route::get('/manager/addlot/{id}', [ManagerController::class, 'addlot'])->name('manager.addlot');
    Route::get('/manager/viewlot/{id}', [ManagerController::class, 'viewlot'])->name('manager.viewlot');
    Route::post('/manager/addlotdb', [LotController::class, 'store'])->name('manager.addlotdb');
    Route::get('/manager/qrcode/{id}', [LotController::class, 'show'])->name('manager.qrcode');
    Route::post('/print', [LotController::class, 'printData'])->name('data.print');
    

    Route::get('/manager/gallery', [ManagerController::class, 'gallery'])->name('manager.gallery');
    Route::get('/manager/pictures/{fid}', [PictureController::class, 'index'])->name('manager.pictures.index');
    Route::get('/pictures/create', [PictureController::class, 'create'])->name('pictures.create');
    Route::post('/pictures', [PictureController::class, 'store'])->name('pictures.store');
    Route::delete('/pictures/{picture}', [PictureController::class, 'destroy'])->name('pictures.destroy');
   
});
 
