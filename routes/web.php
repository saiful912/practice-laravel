<?php



//
//Route::group(['namespace'=>'Frontend','name'=>'frontend.'],function (){
//    Route::get('/', 'Homecontroller@showIndex')->name('index');
//    Route::get('/about', 'Homecontroller@showAbout')->name('about');
//    Route::get('/users/{id}/{name?}', 'Homecontroller@showUser')->where(['id'=>'[0-9]+','name'=>'[a-z]+']);
//});



Route::get('/','Frontend\Homecontroller@Index');
Route::get('/about','Frontend\Homecontroller@showAbout');
Route::get('/post','Frontend\Homecontroller@post');
Route::get('/register','Frontend\HomeController@showRegistrationFrom')->name('register');
Route::post('/register','Frontend\HomeController@showprocessRegistration');

Route::get('/verify/{token}','Frontend\HomeController@verifyEmail')->name('verify');

Route::get('/login','Frontend\HomeController@showLoginFrom')->name('login');
Route::post('/login','Frontend\HomeController@processLoginFrom');
Route::get('/home','Frontend\HomeController@showHome')->name('home');
Route::get('/logout','Frontend\HomeController@Logout')->name('logout');
//Categories
Route::get('/categories','Backend\categoryController@showindex')->name('categories.index');
Route::get('/categories/add','Backend\categoryController@create')->name('categories.create');
Route::post('/categories','Backend\categoryController@store')->name('categories.store');
Route::get('/categories/{id}','Backend\categoryController@show')->name('categories.show');
Route::get('/categories/{id}/edit','Backend\categoryController@edit')->name('categories.edit');
Route::put('/categories/{id}','Backend\categoryController@update')->name('categories.update');
Route::delete('/categories/{id}','Backend\categoryController@delete')->name('categories.delete');

Route::resource('/posts', 'Backend\PostController');

//Route::group(['prefix'=>'admin'],function (){
//    Route::get('/create','Frontend\Homecontroller@showIndex');
//    Route::get('/update','Frontend\Homecontroller@showIndex');
//});

//Route::name('backend.')->namespace('Backend')->prefix('backend')->group(function () {
//    Route::get('/contact', 'FrontController@showContact')->name('contact.showContact');
//    Route::get('/users/{id}', 'FrontController@showUser')->name('users.showUser');
//});


//post
