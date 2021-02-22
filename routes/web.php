<?php

use App\Http\Livewire\NewsFeed;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Tags;
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

//Route::get('/', function () {
//    return view('auth/login');
//});

//Route::get('/profile/{user}', function () {
//    dd(request('user'));
//});

//Route::middleware('auth')->group(function () {
Route::get('profile/{user:username}', Profile::class)->name('profile');
//Route::get('/', NewsFeed::class)->name('feed');
//});

Route::middleware(['auth:sanctum', 'verified'])->group( function () {
    Route::get('/', NewsFeed::class)->name('feed');
    Route::get('/tags/{tag:name}', Tags::class)->name('tags');
});
