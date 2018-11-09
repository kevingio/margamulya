<?php

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

date_default_timezone_set('Asia/Bangkok');

// Auth::routes();
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login',  'Auth\LoginController@showLoginForm');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/directory', 'HomeController@directory')->name('directory');
Route::get('/article', 'HomeController@article')->name('article');
Route::get('/article/{id}', 'HomeController@showArticle')->name('show-article');
Route::get('/event', 'HomeController@event')->name('event');
Route::get('/event/{id}', 'HomeController@showEvent')->name('show-event');
Route::get('/warta-jemaat', 'HomeController@wartaJemaat')->name('warta-jemaat');
Route::get('/warta-jemaat/{id}', 'HomeController@showWartaJemaat')->name('show-warta-jemaat');
Route::get('/warta-umum', 'HomeController@wartaUmum')->name('warta-umum');
Route::get('/warta-umum/{id}', 'HomeController@showWartaUmum')->name('show-warta-umum');
Route::get('/about/{page}', 'HomeController@showMenuAbout')->name('about');
Route::post('/contact-form/send', 'HomeController@sendMailContact')->name('send-contact-form');
Route::post('/search/autocomplete', 'HomeController@searchSuggestions')->name('search-autocomplete');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('/', 'Admin\HomeController');
    Route::resource('/jemaat', 'Admin\JemaatController');
    Route::resource('/article', 'Admin\ArticleController');
    Route::resource('/profile', 'Admin\UserController');
    Route::resource('/gallery', 'Admin\FileController');
    Route::resource('/warta', 'Admin\WartaController');
    Route::resource('/calendar', 'Admin\CalendarController');
    Route::get('/change-password', 'Admin\UserController@showFormChangePassword')->name('change-password');
    Route::post('/change-password', 'Admin\UserController@changePassword')->name('submit-change-password');
    Route::get('/download', 'Admin\JemaatController@getDownload')->name('download-file');
    Route::get('/article/create', 'Admin\ArticleController@newArticle')->name('new-article');
    Route::put('/gallery/setThumbnail/{id}', 'Admin\CalendarController@setThumbnail')->name('set-thumbnail');

    /* Ajax from Admin Dashboard */
    Route::any('/ajax/{page}', function ($page) {
        $app = app();
        return App::call('\App\Http\Controllers\Admin\\'.studly_case($page).'Controller@ajax');
    });
});
