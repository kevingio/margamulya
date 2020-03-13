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

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login',  'Auth\LoginController@showLoginForm');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/directory', 'HomeController@directory')->name('directory');
Route::get('/article', 'HomeController@article')->name('article');
Route::get('/article/{id}', 'HomeController@showArticle')->name('show-article');
Route::get('/event', 'HomeController@event')->name('event');
Route::get('/event/{id}', 'HomeController@showEvent')->name('show-event');
Route::get('/warta', 'HomeController@warta')->name('warta');
Route::get('/warta/{id}', 'HomeController@showWarta')->name('show-warta');
Route::get('/about/{page}', 'HomeController@showMenuAbout')->name('about');
Route::post('/contact-form/send', 'HomeController@sendMailContact')->name('send-contact-form');
Route::post('/search/autocomplete', 'HomeController@searchSuggestions')->name('search-autocomplete');

Route::prefix('admin')->middleware(['auth', 'web'])->namespace('Admin')->group(function () {
    Route::resource('/article', 'ArticleController');
    Route::resource('/profile', 'UserController');
    Route::get('/change-password', 'UserController@showFormChangePassword')->name('change-password');
    Route::post('/change-password', 'UserController@changePassword')->name('submit-change-password');
    Route::middleware('role:admin')->group(function () {
        Route::resource('/', 'HomeController');
        Route::resource('/jemaat', 'JemaatController');
        Route::resource('/gallery', 'FileController');
        Route::resource('/warta', 'WartaController');
        Route::resource('/calendar', 'CalendarController');
        Route::resource('/kontributor', 'ContributorController');
        Route::get('/download', 'JemaatController@getDownload')->name('download-file');
        Route::put('/gallery/setThumbnail/{id}', 'CalendarController@setThumbnail')->name('set-thumbnail');
    });

    /* Ajax from Admin Dashboard */
    Route::any('/ajax/{page}', function ($page) {
        $app = app();
        return App::call('\App\Http\Controllers\Admin\\'.studly_case($page).'Controller@ajax');
    });
});
