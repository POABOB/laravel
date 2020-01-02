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
/*	常用的路由
|	Route::get($uri, $callback);
|	Route::post($uri, $callback);
|	Route::any($uri, $callback);
*/


//命名路由1
Route::get('/user', ['as' => 'user', function(){
	echo route('user');
	return '<h1>我用\'as\'=>\'user\'來命名這個路由，只要調用route(\'user\')就會顯示上方URL</h1>';
}]);




//前台group
Route::group(['middleware' => 'web'], function(){

	// Route::get('/', function () {
	// 	return view('welcome');
	// });

	Route::get('/', 'HomeController@index');
	Route::match(['get', 'post'], '/good/{id}', 'GoodsController@index');
	Route::match(['get', 'post'], '/carts/{id}', 'CartsController@index');
	Route::post('/search/{str}', 'SearchController@index');

	Route::get('/forgot', 'Auth\ForgotPasswordController@forgot');
	Route::post('/forgot', 'Auth\ForgotPasswordController@password');
	Route::get('/active/{email}/{code}', 'Auth\ForgotPasswordController@active')->where(['email' => '[A-Za-z@.0-9]+'], ['code' => '0-9a-zA-Z']);
	Route::get('/reset_password', 'Auth\ResetPasswordController@index');
	Route::post('/reset_password', 'Auth\ResetPasswordController@reset');


	/*************************************************
	 *				Member專區(登入)					 *
	 ************************************************/
	Route::post('/register', 'Auth\RegisterController@index');
	Route::get('/checkEmail/{email}', 'Auth\RegisterController@checkEmail');
	Route::get('/captcha', 'LoginController@captcha');
	Route::get('/getcode', 'LoginController@getcode');
	Route::match(['get', 'post'], '/login', 'LoginController@index');
	//第三方登入(MEMBER)
	Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
	Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

	/*************************************************
	 *				Admin專區(登入)					 *
	 ************************************************/
	Route::match(['get', 'post'], '/admin/login', 'Admin\LoginController@index');
	//驗證碼圖片與SESSION值
	Route::get('/admin/captcha', 'Admin\LoginController@captcha');

	//第三方登入(ADMIN)
	Route::get('auth/admin/{provider}', 'Auth\LoginController@adminRedirectToProvider');
	Route::get('auth/admin/{provider}/callback', 'Auth\LoginController@adminHandleProviderCallback');
	// Route::get('/admin/getcode', 'Admin\LoginController@getcode');

	//密碼加密加鹽
	// Route::get('/admin/crypto', 'Admin\LoginController@crypto');


	//命名路由2 ->較推薦
	// Route::get('/test', 'Admin\HomeController@index')->name('test');


	/*************************************************
	 *				購物車增刪改查					 *
	 ************************************************/
	Route::get('/cart/', 'CartController@index');
	Route::post('/cart/addCarts', 'CartController@add');
	Route::post('/cart/addToCarts', 'CartController@addAndBuy');
	Route::get('/cart/delete/{rowId}', 'CartController@delete');
	Route::any('/cart/buy', 'CartController@buy');
	Route::post('/cart/update', 'CartController@update4post');
	Route::get('/cart/update', 'CartController@update4get');
});


//前台會員group
Route::group(['prefix' => 'member', 'middleware' => ['web', 'member.login']], function(){

	//登入路由
	Route::get('/logout', 'LoginController@logout');
	Route::any('/change_password', 'LoginController@change_password');

	//Member頁面
	Route::get('/', 'MemberController@index');
	Route::get('/needUpdate', 'MemberController@needUpdate');
	Route::post('/update', 'MemberController@update_data');


	//密碼加密加鹽
	// Route::get('/admin/crypto', 'Admin\LoginController@crypto');


	//命名路由2 ->較推薦
	// Route::get('/test', 'Admin\HomeController@index')->name('test');
});


//後台group
//group可以加前綴、命名空間、domain name
//middle 保護機制 session、CSRF
//把路由分組 並賦予前綴(admin) 和命名空間(Admin)
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web', 'admin.login']], function(){
	//Admin路由
	Route::get('/', 'HomeController@index');

	//訂單路由
	Route::any('/order', 'HomeController@order');

	//商品路由
	Route::get('/goods', 'HomeController@goods');
	Route::get('/addgoods', 'GoodsController@addgoods');
	Route::post('/addgoods', 'GoodsController@store');
	Route::get('/goods/edit/{id}', 'GoodsController@editgoods');
	Route::post('/goods/edit/{id}', 'GoodsController@edit');
	Route::get('/goods/delete/{id}', 'GoodsController@delete');
	
	//買家路由
	Route::any('/buyers', 'HomeController@buyers');
	Route::any('/shipping', 'HomeController@shipping');
	Route::any('/setting', 'HomeController@setting');

	//登入登出路由
	Route::get('/logout', 'LoginController@logout');
	Route::any('/change_password', 'LoginController@change_password');
	// Route::get('/login', 'HomeController@adminLogin');
	//restful 直接有 index store update destory show edit ctreate 七個路由
	// Route::resource('article', 'ArticleController');
});

