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
Route::get('/', 'HomeController@index')->name('home');


    Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::middleware(['auth'])->group( function(){
    Route::get('/home', 'HomeController@index')->name('admin.home');

    Route::get('/admin/home', 'HomeController@index')->name('admin.home');
    Route::get('/admin/dashboard', 'DashboardController@index')->name('admin.dashboard');

    /** Routing Pengelolaan Dosen */
    Route::post('/admin/dosen/cari', 'DosenCariController@show')->name('admin.dosencari.show'); //routing pencarian dosen
    Route::get('/admin/dosen/cari', 'DosenController@index')->name('admin.dosencari.index'); //routing pencarian dosen

    Route::get('/admin/dosen', 'DosenController@index')->name('admin.dosen.index');  //routing lihat daftar dosen
    Route::post('/admin/dosen', 'DosenController@store')->name('admin.dosen.store'); //routing simpan data dosen baru
    Route::get('/admin/dosen/create', 'DosenController@create')->name('admin.dosen.create'); //routing tampilkan form data dosen baru
    Route::delete('/admin/dosen/{dosen}', 'DosenController@destroy')->name('admin.dosen.destroy'); //routing hapus data dosen baru
    Route::patch('/admin/dosen/{dosen}', 'DosenController@update')->name('admin.dosen.update'); //routing simpan perubahan data dosen
    Route::get('/admin/dosen/{dosen}', 'DosenController@show')->name('admin.dosen.show'); //routing tampilkan detail dosen
    Route::get('/admin/dosen/{dosen}/edit', 'DosenController@edit')->name('admin.dosen.edit');  //routing tampilkan form edit dosen


    /** Routing Pengelolaan Mahasiswa */
    Route::post('/admin/mahasiswa/cari', 'MahasiswaCariController@show')->name('admin.mahasiswacari.show'); //routing pencarian mahasiswa
    Route::get('/admin/mahasiswa/cari', 'MahasiswaController@index')->name('admin.mahasiswacari.index'); //routing pencarian mahasiswa
    Route::get('/admin/mahasiswa', 'MahasiswaController@index')->name('admin.mahasiswa.index');  //routing lihat daftar mahasiswa
    Route::post('/admin/mahasiswa', 'MahasiswaController@store')->name('admin.mahasiswa.store'); //routing simpan data mahasiswa baru
    Route::get('/admin/mahasiswa/create', 'MahasiswaController@create')->name('admin.mahasiswa.create'); //routing tampilkan form data mahasiswa baru
    Route::delete('/admin/mahasiswa/{mahasiswa}', 'MahasiswaController@destroy')->name('admin.mahasiswa.destroy'); //routing hapus data mahasiswa baru
    Route::patch('/admin/mahasiswa/{mahasiswa}', 'MahasiswaController@update')->name('admin.mahasiswa.update'); //routing simpan perubahan data mahasiswa
    Route::get('/admin/mahasiswa/{mahasiswa}', 'MahasiswaController@show')->name('admin.mahasiswa.show'); //routing tampilkan detail mahasiswa
    Route::get('/admin/mahasiswa/{mahasiswa}/edit', 'MahasiswaController@edit')->name('admin.mahasiswa.edit');  //routing tampilkan form edit mahasiswa

    /** Routing untuk tugas mulai dari sini */


    // Routing sidang TA


    Route::get('/admin/sidang', 'SidangController@index')->name('admin.sidang_ta.index');
    Route::get('/admin/sidang/create', 'SidangController@create')->name('admin.sidang_ta.create');
    Route::post('/admin/sidang/store', 'SidangController@store')->name('admin.sidang_ta.store');
    Route::get('/admin/sidang/{taSidang}/edit', 'SidangController@edit')->name('admin.sidang_ta.edit');
    Route::patch('/admin/sidang/{taSidang}', 'SidangController@update')->name('admin.sidang_ta.update');


    Route::get('/admin/sidang', 'SidangController@index')->name('admin.sidang.index');



    Route::get('/admin/sidang_ta', 'SidangController@index')->name('admin.sidang_ta.index');
    Route::post('/admin/sidang_ta', 'SidangController@store')->name('admin.sidang_ta.store'); //routing simpan data sidangta baru
    Route::get('/admin/sidang_ta/create', 'SidangController@create')->name('admin.sidang_ta.create'); //routing tampilkan form data sidangta baru
    Route::delete('/admin/sidang_ta/{sidangta}', 'SidangController@destroy')->name('admin.sidang_ta.destroy'); //routing hapus data sidangta baru
    Route::patch('/admin/sidang_ta/{sidangta}', 'SidangController@update')->name('admin.sidang_ta.update'); //routing simpan perubahan data sidangta

    Route::get('/admin/sidang_ta/{sidangta}', 'SidangtaController@show')->name('admin.sidang_ta.show'); //routing tampilkan detail sidangta
    Route::get('/admin/sidang_ta/{sidangta}/edit', 'SidangtaController@edit')->name('admin.sidang_ta.edit');  //routing tampilkan form edit sidangta

    /** Pengelolaan Penelitian */
    Route::get('/admin/penelitian', 'PenelitianController@index')->name('admin.penelitian.index');  //routing lihat daftar mahasiswa
    Route::post('/admin/penelitian', 'PenelitianController@store')->name('admin.penelitian.store'); //routing simpan data mahasiswa baru
    Route::get('/admin/penelitian/create', 'PenelitianController@create')->name('admin.penelitian.create'); //routing tampilkan form data mahasiswa baru
    Route::delete('/admin/penelitian/{penelitian}', 'PenelitianController@destroy')->name('admin.penelitian.destroy'); //routing hapus data mahasiswa baru
    Route::patch('/admin/penelitian/{penelitian}', 'PenelitianController@update')->name('admin.penelitian.update'); //routing simpan perubahan data mahasiswa
    Route::get('/admin/penelitian/{penelitian}', 'PenelitianController@show')->name('admin.penelitian.show'); //routing tampilkan detail mahasiswa
    Route::get('/admin/penelitian/{penelitian}/edit', 'PenelitianController@edit')->name('admin.penelitian.edit');  //routing tampilkan form edit mahasiswa

    Route::post('/admin/penelitian-user/create', 'PenelitianUserController@store')->name('admin.penelitian-user.store'); //form tambah anggota
    Route::get('/admin/penelitian-user/create/{penelitian}', 'PenelitianUserController@create')->name('admin.penelitian-user.create'); //form tambah anggota
    Route::delete('/admin/penelitian-user/{penelitian}/{user}', 'PenelitianUserController@destroy')->name('admin.penelitian-user.destroy'); //hapus anggota



    Route::post('/admin/sidang_ta/member', 'SidangController@insert')->name('admin.sidang_ta.insert'); //roting simpan data sidang baru
    Route::get('/admin/proposal-kp/{id}/add', 'SidangController@add')->name('admin.sidang_ta.add'); //routing menampilkan form tambah penguji sidang


    Route::get('pembimbing/submit', 'PembimbingSubmissionController@create')->name('admin.pembimbing.create');
    Route::post('pembimbing/submit', 'PembimbingSubmissionController@store')->name('admin.pembimbing.store');

});

Route::get('/', function () {
    return view('auth/login');
});
Auth::routes();
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    //Laravel Permission spatie/permissions
    Route::resource('permissions', 'Backend\PermissionsController');
    // Route::post('permissions_mass_destroy', ['uses' => 'Backend\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Backend\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Backend\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Backend\UsersController');
    // Route::post('users_mass_destroy', ['uses' => 'Backend\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
});

