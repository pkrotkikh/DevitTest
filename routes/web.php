<?php

use App\Console\Commands\GetRSSPosts;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
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
//    $postRepository = new CategoryRepository();
//    $postRepository = new PostRepository($postRepository);
//    $posts = new GetRSSPosts($postRepository);
//    $posts->handle();
    return view('welcome');
});
