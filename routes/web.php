<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JeuController;

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
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->get('/dashboard', [HomeController::class, 'cinqAleatoires'])->name('dashboard');

Route::middleware(['auth'])->get('/dashboard/5meilleurs', [HomeController::class, 'cinqMeilleurs'])->name('dashboard.5meilleurs');

//Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/jeux/show/{id}', [JeuController::class, 'show'])->name('jeu.show');

Route::get('/jeux/rules/{id}', [JeuController::class, 'rules'])->name('jeu.rules');

Route::get('/jeux/create', [JeuController::class, 'create'])->name('jeu.create');

Route::post('/jeux/create', [JeuController::class, 'store'])->name('jeu.store')->middleware('auth');

Route::get('/jeux/{sort?}/{page?}', [JeuController::class, 'index'])->name('jeu.index');

Route::post('/comment/{id}', [JeuController::class, 'comment'])->name('jeu.comment')->middleware('auth');

Route::get('/enonce', function () {
    return view('enonce.index');
});

Route::get('/jeux/search',[JeuController::class,'search'])->name('jeu.search');

Route::get('/profile/{id}',[UserController::class,'profil'])->name('profile.profil')->middleware('auth');

Route::post('/profile/{id}', [UserController::class, 'storeAchat'])->name('user.storeAchat')->middleware('auth');

Route::post('/profile/{id}', [UserController::class, 'destroyAchat'])->name('user.destroyAchat')->middleware('auth');
