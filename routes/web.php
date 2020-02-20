<?php

Auth::routes(['register' => false]);
Route::get('/', function () {
    return view('admin.pages.dashboard');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'login'], function () use ($router) {
    $router->get('/admin', 'Auth\LoginController@showAdminLoginForm')->name('view.login.admin');
    $router->get('/siswa', 'Auth\LoginController@showSiswaLoginForm')->name('view.login.siswa');
    $router->post('/admin', 'Auth\LoginController@adminLogin');
    $router->post('/siswa', 'Auth\LoginController@siswaLogin');
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth.petugas', 'auth']], function () use ($router) {
    $router->get('/', 'Admin\MainController@dashboard')->name('admin.dashboard');

    // crud tahun ajaran
    $router->group(['prefix' => 'tahun-ajaran'], function () use ($router) {
        $router->get('/', 'Admin\TahunAjaranController@index')->name('admin.ta_index');
        $router->post('/store', 'Admin\TahunAjaranController@store')->name('admin.ta_store');
        $router->post('/update', 'Admin\TahunAjaranController@update')->name('admin.ta_update');
        $router->get('/find/{id}', 'Admin\TahunAjaranController@show')->name('admin.ta_show');
        $router->get('/{id}/delete', 'Admin\TahunAjaranController@destroy')->name('admin.ta_delete');
        $router->get('/{id}/setting', 'Admin\TahunAjaranController@setting')->name('admin.ta_setting');
        $router->post('/{id}/setting', 'Admin\TahunAjaranController@saveSetting')->name('admin.ta_save_setting');
        $router->get('/{id}/setting/view', 'Admin\TahunAjaranController@viewSetting')->name('admin.ta_view_setting');
        $router->get('/{id}/setting/edit', 'Admin\TahunAjaranController@editSetting')->name('admin.ta_edit_setting');
        $router->post('/{id}/setting/update', 'Admin\TahunAjaranController@updateSetting')->name('admin.ta_update_setting');
    });

    // crud kelas
    $router->group(['prefix' => 'kelas'], function () use ($router) {
        $router->get('/', 'Admin\KelasController@index')->name('admin.kelas_index');
        $router->post('/store', 'Admin\KelasController@store')->name('admin.kelas_create');
        $router->post('/update', 'Admin\KelasController@update')->name('admin.kelas_update');
        $router->get('/{id}/siswa', 'Admin\KelasController@siswa')->name('admin.kelas_siswa');
        $router->get('/{id}/siswa/create', 'Admin\KelasController@createSiswaByKelas')->name('admin.kelas_tambah_siswa');
        $router->get('/find/{id}', 'Admin\KelasController@show')->name('admin.kelas_show');
        $router->get('/delete/{id}', 'Admin\KelasController@destroy')->name('admin.kelas_delete');
    });
});



Route::group(['prefix' => 'siswa', 'middleware' => ['auth.siswa', 'auth']], function () use ($router) {
    $router->get('/', function () {
        return "siswa";
    });
});
