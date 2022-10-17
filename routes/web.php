<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'userindex']);
Route::get('/about', [App\Http\Controllers\HomeController::class, 'Aboutus']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'userindex'])->name('home');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.route')->middleware('auth');

Route::get('/post/{id}', [App\Http\Controllers\HomeController::class, 'postById']);
Route::get('/postByTag/{id}', [App\Http\Controllers\HomeController::class, 'postByTag']);
// Route::post('/postByTag', [App\Http\Controllers\HomeController::class, 'postByTag']);

Route::post('/subscribe', 'SubscribeController@SubscribeStore')->name('subscribe');
Route::get('/send-mail', 'SubscribeController@sendmail');

// comment stroe
Route::post('/blogdeatilsComment', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store')->middleware('auth');

Route::get('/getAllComments/{id}', [App\Http\Controllers\CommentController::class, 'getAllComments'])->middleware('auth');

Route::post('/comment-reply', 'ReplayCommentController@store')->name('reply.store')->middleware('auth');
Route::post('/reply-comment-reply', 'ReplayCommentController@supReplay')->name('subreply.supReplay')->middleware('auth');

// user blog area
Route::get('/blogdeatils/{id}/{title}', [App\Http\Controllers\HomeController::class, 'showBlogDetails']);
Route::get('/likesall/{id}', [App\Http\Controllers\LikeController::class, 'showLikeDetails']);
// Route::get('/likesall', [App\Http\Controllers\LikeController::class, 'showLikeDetails']);

// menus route
Route::post('/CreateNewMenu', [App\Http\Controllers\MenuController::class, 'storeMenu']);
Route::post('/MenusStatus', [App\Http\Controllers\MenuController::class, 'MenusStatus']);
Route::post('/MenusDetails', [App\Http\Controllers\MenuController::class, 'MenusDetails']);
Route::post('/updateMenu', [App\Http\Controllers\MenuController::class, 'updateMenu']);
Route::post('/MenuDelete', [App\Http\Controllers\MenuController::class, 'MenuDelete']);
Route::get('/managemenu', [App\Http\Controllers\MenuController::class, 'MenuPage'])->middleware('auth');
Route::get('/ShowAllMenu', [App\Http\Controllers\MenuController::class, 'ShowAllMenu']);

// settings routes
Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'getSettingsPage']);
Route::post('/setting/update', [App\Http\Controllers\SettingsController::class, 'settingsUpdate']);

// topic routes
Route::get('/topics', [App\Http\Controllers\TopicController::class, 'index']);
Route::get('/ShowAllTopic', [App\Http\Controllers\TopicController::class, 'show']);
Route::post('/CreateNewTopic', [App\Http\Controllers\TopicController::class, 'store']);
Route::post('/TopicsDetails', [App\Http\Controllers\TopicController::class, 'edit']);
Route::post('/updateTopic', [App\Http\Controllers\TopicController::class, 'update']);
Route::post('/TopicsStatus', [App\Http\Controllers\TopicController::class, 'updateStatus']);
Route::post('/TopicDelete', [App\Http\Controllers\TopicController::class, 'destroy']);


// tags routes
Route::get('/tags', [App\Http\Controllers\TagController::class, 'index']);
Route::get('/ShowAllTag', [App\Http\Controllers\TagController::class, 'show']);
Route::post('/CreateNewTag', [App\Http\Controllers\TagController::class, 'store']);
Route::post('/TagsDetails', [App\Http\Controllers\TagController::class, 'edit']);
Route::post('/updateTag', [App\Http\Controllers\TagController::class, 'update']);
Route::post('/TagsStatus', [App\Http\Controllers\TagController::class, 'updateStatus']);
Route::post('/TagDelete', [App\Http\Controllers\TagController::class, 'destroy']);


// blog route
Route::post('/CreateNewBlog', [App\Http\Controllers\BlogController::class, 'storeBlog']);
Route::post('/BlogsStatus', [App\Http\Controllers\BlogController::class, 'BlogsStatus']);
Route::post('/BlogsDetails', [App\Http\Controllers\BlogController::class, 'BlogsDetails']);
Route::post('/updateBlog', [App\Http\Controllers\BlogController::class, 'updateBlog']);
Route::post('/BlogDelete', [App\Http\Controllers\BlogController::class, 'BlogDelete']);
Route::get('/manageblog', [App\Http\Controllers\BlogController::class, 'BlogPage'])->middleware('auth');
Route::get('/ShowAllBlog', [App\Http\Controllers\BlogController::class, 'ShowAllBlog']);


Route::post('like',[\App\Http\Controllers\LikeController::class,'pressLike'])->name('pressLike');







// google login

Route::get('/privacypolicy',[App\Http\Controllers\GoogleLoginController::class,'privacypolicy']);

Route::get('login/google',[App\Http\Controllers\GoogleLoginController::class,'googleRedirect']);
Route::get('login/callback/google',[App\Http\Controllers\GoogleLoginController::class,'loginWithGoogle']);

Route::get('login/facebook',[App\Http\Controllers\GoogleLoginController::class,'facebookRedirect']);
Route::get('login/facebook/callback',[App\Http\Controllers\GoogleLoginController::class,'loginWithFacebook']);

Route::get('login/github',[App\Http\Controllers\GoogleLoginController::class,'githubRedirect']);
Route::get('login/callback/github',[App\Http\Controllers\GoogleLoginController::class,'loginWithGithub']);
