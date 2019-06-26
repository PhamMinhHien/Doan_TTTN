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


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/*-----------------------
| ROUTE VỀ VIEW 
-----------------------*/
Route::get('/','PagesController@getHome')->name('home-page');
Route::get('category/{slug}','PagesController@getCategory_Post')->name('category');  
Route::get('post/{slug}.html','PagesController@getPost_Detail');   
Route::get('tag/{tag}','PagesController@getTag_Post');   		
Route::get('author/{name}','PagesController@getAuthor'); 			
Route::get('search','PagesController@getSearch')->name('search'); 
Route::get('contact.html','PagesController@getContact'); 			
Route::get('aboutus.html','PagesController@getAboutus'); 			

Route::post('/sendmail' , 'EmailReceiveController@send');
Route::get('user/activation/{token}', 'EmailReceiveController@activateUser')->name('user.activate');
Route::post('receive-post' , 'EmailReceiveController@activateEmail');


/*-----------------------
| ROUTE VỀ ĐĂNG NHẬP
-----------------------*/

Route::get('login-page','LoginAdminController@getLogin')->name('login-page');
Route::post('login-post' , 'LoginAdminController@postLogin')->name('login-post');
Route::get('logout-admin', 'LoginAdminController@getLogout');


/*-----------------------
| ROUTE VỀ ADMIN
-----------------------*/

Route::group(['prefix' => 'admin' , 'middleware' => 'auth'] , function()
{
	// Dashboard
	Route::get('/', 'DashboardController@getDashboard')->name('dashboard');
	// Profile 
	Route::get('profile','ProfileController@getProfile');
	Route::post('profile/update','ProfileController@profileUpdate');
	// Post
	Route::prefix('post')->group(function(){
		Route::get('/','PostController@getList')->name('list-post'); 
		Route::get('addpost', 'PostController@getAddpost');
 		Route::put('updateStatus', 'PostController@updateStatus');
        Route::put('updateHot', 'PostController@updateHot');
        Route::post('add', 'PostController@postAdd');
        Route::get('update/{id}', 'PostController@getUpdate');
        Route::post('update/{id}', 'PostController@postUpdate');
        Route::get('delete/{id}', 'PostController@getDelete');
	});
	// Page for Admin 
    Route::middleware(['role'])->group(function () {
      	// Category
        Route::prefix('category')->group(function () {
            Route::get('/', 'Admin\CategoryController@getList');
            Route::get('add', 'Admin\CategoryController@getAdd');
            Route::post('add', 'Admin\CategoryController@postAdd');
            Route::get('data', 'Admin\CategoryController@dataTable')->name('data');
            Route::post('update', 'Admin\CategoryController@postUpdate');
            Route::delete('delete', 'Admin\CategoryController@delete');
        });
        // Tag
        Route::prefix('tag')->group(function () {
            Route::get('/', 'Admin\TagController@getList')->name('list-tag');
            Route::get('data', 'Admin\TagController@dataTable')->name('data-tag');
            Route::post('add', 'Admin\TagController@postAdd');
            Route::put('update', 'Admin\TagController@putUpdate');
            Route::delete('delete', 'Admin\TagController@delete');
        });
        // Author 
        Route::prefix('author')->group(function () 
        {
            Route::get('/', 'Admin\AuthorController@getList')->name('list-author');
            Route::get('data', 'Admin\AuthorController@dataTable')->name('data-author');
            Route::post('add', 'Admin\AuthorController@postAdd');
            Route::delete('delete', 'Admin\AuthorController@delete');
        });
    });
});



