<?php

use App\Http\Controllers\ChannelController;
use App\Http\Livewire\Video\AllVideo;
use App\Http\Livewire\Video\CreateVideo;
use App\Http\Livewire\Video\EditVideo;
use App\Http\Livewire\Video\WatchVideo;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
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
    // if login == channels that i subscribed to

    if(Auth::check()){
        $channels = Auth::user()->subscribedChannels()->with('videos')->get()->pluck('videos');

    }else{
        //else all videos
        $channels = Channel::get()->pluck('videos');

    }

    return view('welcome', compact('channels'));

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('test', function(){

//     return view('test');
// });

Route::middleware('auth')->group(function(){

    Route::get('/channel/{channel}/edit', [ChannelController::class, 'edit'])->name('channel.edit');

});

Route::middleware('auth')->group(function(){

    Route::get('/videos/{channel}/create', CreateVideo::class)->name('video.create');

    Route::get('/videos/{channel}/{video}/edit', EditVideo::class)->name('video.edit');

    Route::get('/video/{channel}', AllVideo::class)->name('video.all');
});

Route::get('/watch/{video}', WatchVideo::class)->name('video.watch');

Auth::routes();
