<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'AuthController@index')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::post('/ceklogin', 'AuthController@login');
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::middleware(['akses'])->group(function () {
        Route::get('/role', 'RoleController@index');
        Route::post('/role/aksi', 'RoleController@aksi');

        Route::get('/menu', 'MenuController@index');
        Route::post('/menu/aktif', 'MenuController@aktif');
        Route::post('/menu/up', 'MenuController@up');
        Route::post('/menu/down', 'MenuController@down');
        Route::post('/menu/aksi', 'MenuController@aksi');

        Route::get('/menu/submenu/{menu_id}', 'SubmenuController@index');
        Route::post('/menu/submenu/aksi/{menu_id}', 'SubmenuController@aksi');
        Route::post('/menu/submenu/aktif/{menu_id}', 'SubmenuController@aktif');
        Route::post('/menu/submenu/up/{menu_id}', 'SubmenuController@up');
        Route::post('/menu/submenu/down/{menu_id}', 'SubmenuController@down');

        Route::get('/akses', 'AksesController@index');
        Route::get('/akses/getAkses', 'AksesController@getAkses');
        Route::post('/akses/check', 'AksesController@check');

        Route::get('/user', 'UserController@index');
        Route::post('/user/aksi', 'UserController@aksi');
        Route::post('/user/aktif', 'UserController@aktif');

        Route::get('/data', 'GuruController@index');
        Route::post('/data/aksi', 'GuruController@aksi');

        Route::get('/data/siswa', 'SiswaController@index');
        Route::post('/data/siswa/aksi', 'SiswaController@aksi');

        Route::get('/data/jurusan', 'JurusanController@index');
        Route::post('/data/jurusan/aksi', 'JurusanController@aksi');

        Route::get('/data/kelas', 'KelasController@index');
        Route::post('/data/kelas/aksi', 'KelasController@aksi');

        Route::get('/siswa', 'DataPelanggaranController@index');
        Route::get('/siswa/kelas/{id}', 'DataPelanggaranController@kelas');
        Route::get('/siswa/print/{id}/{poin}', 'DataPelanggaranController@print');
        Route::get('/siswa/kelas/data/{id}', 'DataPelanggaranController@siswa');
        Route::post('/siswa/kelas/data/simpan', 'DataPelanggaranController@simpan');

        Route::get('/data/kelas/datakelas/{id}', 'DataKelasController@index');
        Route::post('/data/kelas/datakelas/aksi/{id}', 'DataKelasController@aksi');

        Route::get('/perhitungan', 'KriteriaController@index');
        Route::post('/perhitungan/aksi', 'KriteriaController@aksi');

        Route::get('/perhitungan/pelanggaran/{id}', 'PelanggaranController@index');
        Route::post('/perhitungan/pelanggaran/aksi/{id}', 'PelanggaranController@aksi');

        Route::get('/perhitungan/geomean', 'KuisionerController@geomean');
        Route::get('/perhitungan/saw', 'KuisionerController@saw');

        Route::get('/kuisioner', 'KuisionerController@index');
        Route::post('/kuisioner/simpan', 'KuisionerController@simpan');
    });
});
