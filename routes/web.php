<?php

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'login'], function () use ($router) {
    $router->get('/admin', 'Auth\LoginController@showAdminLoginForm')->name('view.login.admin');
    $router->get('/siswa', 'Auth\LoginController@showSiswaLoginForm')->name('view.login.siswa');
    $router->post('/admin', 'Auth\LoginController@adminLogin');
    $router->post('/siswa', 'Auth\LoginController@siswaLogin');
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth.petugas', 'auth']], function () use ($router) {
    $router->get('/', 'Admin\MainController@dashboard')->name('admin.dashboard');
    $router->get('/profile', 'Admin\MainController@profile')->name('admin.profile');
    $router->post('/profile', 'Admin\MainController@updateProfile')->name('admin.profile_update');
    $router->get('/changepassword', 'Admin\MainController@changePassword')->name('admin.change_password');
    $router->post('/changepassword', 'Admin\MainController@updatePassword')->name('admin.password_update');

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

    // crud siswa
    $router->group(['prefix' => 'siswa'], function () use ($router) {
        $router->get('/', 'Admin\SiswaController@index')->name('admin.siswa_index');
        $router->get('/create', 'Admin\SiswaController@create')->name('admin.siswa_create');
        $router->post('/store', 'Admin\SiswaController@store')->name('admin.siswa_store');
        $router->post('/update/{id}', 'Admin\SiswaController@update')->name('admin.siswa_update');
        $router->get('/{id}/edit', 'Admin\SiswaController@show')->name('admin.siswa_show');
        $router->get('/{id}/detail', 'Admin\SiswaController@detail')->name('admin.siswa_detail');
        $router->get('/delete/{id}', 'Admin\SiswaController@destroy')->name('admin.siswa_delete');
    });

    // crud spp
    $router->group(['prefix' => 'spp'], function () use ($router) {
        $router->get('/', 'Admin\SppController@index')->name('admin.spp_index');
        $router->post('/store', 'Admin\SppController@store')->name('admin.spp_create');
        $router->post('/update', 'Admin\SppController@update')->name('admin.spp_update');
        $router->get('/find/{id}', 'Admin\SppController@show')->name('admin.spp_show');
        $router->get('/delete/{id}', 'Admin\SppController@destroy')->name('admin.spp_delete');
    });

    // crud petugas
    $router->group(['prefix' => 'petugas'], function () use ($router) {
        $router->get('/', 'Admin\PetugasController@index')->name('admin.petugas_index');
        $router->post('/store', 'Admin\PetugasController@store')->name('admin.petugas_store');
        $router->get('/create', 'Admin\PetugasController@create')->name('admin.petugas_create');
        $router->post('/{id}/update', 'Admin\PetugasController@update')->name('admin.petugas_update');
        $router->get('{id}/edit', 'Admin\PetugasController@show')->name('admin.petugas_edit');
        $router->get('{id}/delete', 'Admin\PetugasController@delete')->name('admin.petugas_delete');
    });

    $router->group(['prefix' => 'pembayaran'], function () use ($router) {
        $router->get('/', 'Admin\PembayaranController@index')->name('admin.pembayaran_index');
    });
});



Route::group(['prefix' => 'siswa', 'middleware' => ['auth.siswa', 'auth']], function () use ($router) {
    $router->get('/', function () {
        return "siswa";
    });
});
