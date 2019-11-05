<?php

// Login
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return redirect('/login');
});
Route::match(["GET", "POST"], "/register", function () {
    return redirect("/login");
})->name("register");


// supervisor
Route::group(['prefix' => '/supervisor'], function () {
    Route::get('/', 'SuperController@index')->name('super.index');
});
Route::resource('/supervisor/user', 'UserController');


// admin upload
Route::group(['prefix' => '/admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::post('/igd/create', 'AdminController@create_rek')->name('admin.create.rek');
    Route::post('/igd/create/s', 'AdminController@store_rek')->name('admin.store.rek');
    Route::get('/igd/{rek_id}/upload', 'AdminController@upload_igd')->name('admin.upload.igd');
    Route::post('/igd/upload/s', 'AdminController@store_igd')->name('admin.store.igd');
});


// dokter
Route::group(['prefix' => '/dokter'], function () {
    Route::get('/', 'DokterController@index')->name('dokter.index');
});
