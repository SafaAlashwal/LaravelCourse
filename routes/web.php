<?php

use App\Mail\testEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomNotificationController;
//use Illuminate\Support\Facades\Route;


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
    
    Route::get('/changeLang/{Lang}', function (string $locale) {
        if (!in_array($locale, ['en', 'ar'])) {
            abort(400);
        }
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    })->name("changeLang");
    
    
    Route::get('/dashboard', function () {
        return view('posts.index');
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::middleware('auth')->group(function () {

        Route::get('fcm_token', [CustomNotificationController::class, 'fcm_token'])
        ->name('fcm_token');
        Route::resource('custom-notifications',CustomNotificationController::class);
    
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
        
    Route::get('/',[PostController::class,'index'])->name('post');
    Route::get('/cards',[PostController::class,'cards'])->name('cards');
    //url,an array of[ controllername , method]
    
    // Route::get('/categories',[CategoryContr oller::class,'index']->name('categories'));//show all cat
    // Route::get('/categories/{id}',[CategoryController::class,'index']->name('show'));//show a cat
    // Route::get('/categories/create',[CategoryController::class,'index']->name('create'));
    // Route::get('/categories/edit',[CategoryController::class,'index']->name('edit'));
    
    // Route::post('/categories/store',[CategoryController::class,'index']->name('store'));
    // Route::put('/categories/update',[CategoryController::class,'index']->name('update'));
    // Route::delete('/categories/{id}',[CategoryController::class,'index']->name('destroy'));
    //Route::resource('categories',CategoryController::class);//name,controller
    Route::resource('categories',CategoryController::class); //->only([])   except([])
    
    Route::resource('brands',BrandController::class);

    Route::get('/products/trashed', [ProductController::class, 'deleted_index'])->name('products.trashed');
    Route::get('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

    Route::resource('products',ProductController::class);
    
    Route::resource('roles',RoleController::class);
    
    Route::resource('users',UserController::class);

    Route::get('/sendEmail',function(){
        Mail::to('s93887882@gmail.com')
        ->send(new testEmail(['title'=>"test Change data"]));

        return '<h1>Email sended</h1>';
    });

 

});
    
require __DIR__.'/auth.php';?>
