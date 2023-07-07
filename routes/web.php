<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::resource('products',ProductController::class);

Route::resource('roles',RoleController::class);

Route::resource('users',UserController::class);
});


require __DIR__.'/auth.php';
