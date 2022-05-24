<?php

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
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::resource('videos', 'App\Http\Controllers\VideoController');

Route::get('/logs', array(
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\LogController@index'
))->name('logs.index');


Route::get('/removeVideo/{id}', array(
    // 'as' => 'removeVideo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\VideoController@removeVideo'
))->name('videos.remove');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


Route::post('/searchVideo', array(
    // 'as' => 'searchVideo',
    // 'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\VideoController@search'
))->name('videos.search');

// Route::post('/searchVideo', array(
//     'as' => 'searchVideo',
//     'uses' => 'App\Http\Controllers\VideoController@search'
// ));

Route::get('/', function(){
    return view('home');
})->name('home');

// Auth::routes();
//
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
