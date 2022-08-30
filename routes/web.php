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
    $news = DB::table('news')
    ->join('categories', 'news.categories_id', '=', 'categories.id')
    ->where('news.status', 1)
    ->select('news.*',  'categories.description as categorydescription')
    ->get();

    return view('welcome', ['news' => $news]);
});

Route::get('/show{id', function($id){
    $news = DB::table('news')
    ->join('categories', 'news.categories_id', '=', 'categories.id')
    ->where('news.id', $id)
    -select('news.*', 'categories.description as categorydescription')
    ->first();

    return view('show', ['news' => $news]);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('news', 'ReportController');