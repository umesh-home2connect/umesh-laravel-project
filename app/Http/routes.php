<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/






//Route::group(array('prefix' => 'admin'), function()
//{
//    Route::get('/', 'Admin\AdminController@index');
//});

//Route::get('form','FormController@index');
//Route::get('/form/create','FormController@create');
//Route::post('form', 'FormController@store');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
    return view('welcome');
    });
    Route::auth();
    
//    Route::controllers([
//                        'password' => 'Auth\PasswordController',
//                    ]);
    Route::get('/home','HomeController@index');
    Route::post('/home','HomeController@postChangeLanguage');
    Route::get('/editprofile','User\EditProfileController@index');
    Route::post('/editprofile','User\EditProfileController@index');
    Route::get('/pdf', 'PdfController@invoice');
     
    Route::get('fileentry', 'FileEntryController@index');
    Route::get('fileentry/get/{filename}', [
	'as' => 'getentry', 'uses' => 'FileEntryController@get']);
    Route::post('fileentry/add',[ 
        'as' => 'addentry', 'uses' => 'FileEntryController@add']);
    Route::get('fileentry/delete/{filename}',['as' => 'deleteentry', 'uses' => 'FileEntryController@delete']);
    
    
    Route::resource('demo','DemoController');
    //Since we’re using Route::resource, we get index, show, create, edit, update, store, and destroy routes defined for us.
    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');
    //AdminController routing
//    Route::get('/admin', 'Admin\AdminController@index');
//    Route::get('/admin/create', 'Admin\AdminController@create');
//    Route::post('/admin', 'Admin\AdminController@store');
////    Route::post('/admin', 'Admin\AdminController@test');
//      Route::get('/admin/test', 'Admin\AdminController@test');
});
