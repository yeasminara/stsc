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

//Route::get('/', 'HomeController@index');
/*
Route::get('/', function () {
    return view('welcome');
});
*/



Route::get('/', 'FontEndController@index');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('/logout', function()
{
    Auth::logout();
    Session::flush();
    return Redirect::to('/');
});

//Route::get('/', 'HomeController@index');
// Registration Routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');
Auth::routes();

Route::get('/home', 'InnerController@index');



Route::get('/class-list', 'ClassesController@index');
Route::get('/add-class', 'ClassesController@create');
Route::post('/add-class', 'ClassesController@store');


Route::get('/edit-class/{id}','ClassesController@edit');
Route::post('/update-class/{id}','ClassesController@update');

Route::get('/delete-class/{id}', 'ClassesController@destroy');

/*========Subject action===========*/

Route::get('/subject-list', 'SubjectsController@index');
Route::get('/add-subject', 'SubjectsController@create');
Route::post('/add-subject', 'SubjectsController@store');
Route::get('/edit-subject/{id}','SubjectsController@edit');
Route::post('update-subject/{id}','SubjectsController@update');
Route::get('/delete-subject/{id}', 'SubjectsController@destroy');


/*========Subject action===========*/

Route::get('/chapter-list', 'ChaptersController@index');
Route::get('/add-chapter', 'ChaptersController@create');
Route::post('/add-chapter', 'ChaptersController@store');
Route::get('/edit-chapter/{id}','ChaptersController@edit');
Route::post('update-chapter/{id}','ChaptersController@update');
Route::get('/delete-chapter/{id}', 'ChaptersController@destroy');
Route::post('/load-subjects-by-class-id', 'ChaptersController@searchChapter');



Route::get('/lesson-list', 'LessonsController@index');
Route::get('/add-lesson', 'LessonsController@create');
Route::post('/add-lesson', 'LessonsController@store');
Route::get('/edit-lesson/{id}','LessonsController@edit');
Route::post('update-lesson/{id}','LessonsController@update');
Route::get('/delete-lesson/{id}', 'LessonsController@destroy');

Route::get('/content-type-list', 'ContentTypesController@index');
Route::get('/add-content-type', 'ContentTypesController@create');
Route::post('/add-content-type', 'ContentTypesController@store');
Route::get('/edit-content-type/{id}','ContentTypesController@edit');
Route::post('update-content-type/{id}','ContentTypesController@update');
Route::get('/delete-content-type/{id}', 'ContentTypesController@destroy');


Route::get('/content-list', 'ContentsController@index');
Route::get('/add-content', 'ContentsController@create');
Route::post('/add-content', 'ContentsController@store');
Route::get('/edit-content/{id}','ContentsController@edit');
Route::post('update-content/{id}','ContentsController@update');
Route::get('/delete-content/{id}', 'ContentsController@destroy');

Route::post('/search-subject','LoadingController@searchSubject');
Route::post('/search-chapter','LoadingController@searchChapter');
Route::post('/search-lesson','LoadingController@searchLesson');
Route::post('/search-chapter-list','ChaptersController@searchChapter');
Route::post('/search-lesson-list','LessonsController@searchLesson');
Route::post('/search-content-list','ContentsController@searchContent');

//