<?php

//use App\Events\WebsocketDemoEvent;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/coba', 'NotifikasiController@coba');
Route::get('/eksport', 'UserController@eksport');
Route::get('/count', 'UserController@count');

Auth::routes();

Route::group(['middleware' => 'web'], function () {
    Route::get('user/profil', 'UserController@profil')->name('user.profil');
    Route::patch('user/{id}/change', 'UserController@changeProfil');
    
    //pol
    Route::get('/pol/data', 'PolController@listData')->name('pol.data');
    Route::resource('/pol', 'PolController');
    
    //notifikasi
    Route::get('/notifikasi/ambil', 'NotifikasiController@ambil_notifikasi');
    Route::get('/notifikasi/data', 'NotifikasiController@listData')->name('notifikasi.data');
    Route::patch('/broadcast/{id}', 'NotifikasiController@broadcast');
    Route::resource('/notifikasi', 'NotifikasiController');
    
    //periode
    Route::get('/periode/data', 'PeriodeController@listData')->name('periode.data');
    Route::resource('/periode', 'PeriodeController');
    
    //kartu sam
    Route::get('/kartu_sam/data', 'KartuSamController@listData')->name('kartu_sam.data');
    Route::resource('/kartu_sam', 'KartuSamController');
    
    //user
    Route::get('/user/data', 'UserController@listData')->name('user.data');
    Route::resource('/user', 'UserController');
    
    //applet
    Route::get('/applet/data', 'AppletController@listData')->name('applet_pengganti.data');
    Route::post('/applet/pengganti', 'AppletController@proses_pengganti')->name('proses_applet_pengganti');
    Route::patch('/applet/update_pengganti/{id}', 'AppletController@update_pengganti')->name('update_applet_pengganti');
    Route::get('/applet/tbl_laporan/{operator}/{tanggal}', 'AppletController@tbl_laporan');
    Route::get('/applet', 'AppletController@index')->name('applet.index');
    Route::post('/applet/simpan_sementara', 'AppletController@simpan_sementara');
    Route::get('/applet/tbl_laporan_sementara/{operator}', 'AppletController@tbl_laporan_sementara');    
    Route::delete('/applet/{id}', 'AppletController@hapus');
    Route::post('/applet/upload', 'AppletController@upload');
    Route::patch('/applet/update/{id}', 'AppletController@update');
    Route::get('/applet/pengganti','AppletController@pengganti')->name('applet_pengganti');    
    
    
    Route::get('/preperso/upload/sam', 'AppletController@sam')->name('upload_sam');
    Route::post('/preperso/upload/sam', 'AppletController@prosessam')->name('proses_sam');
    
    //Preperso	
    Route::post('/preperso/preperso/simpan_sementara', 'PrepersoController@simpan_sementara');
    Route::get('/preperso/preperso/tbl_laporan_sementara/{operator}/{tipe}', 'PrepersoController@tbl_laporan_sementara');
    Route::get('/preperso/preperso/tbl_laporan/{operator}/{tanggal}/{tipe}', 'PrepersoController@tbl_laporan');
    Route::delete('/preperso/preperso/{id}', 'PrepersoController@hapus');
    Route::post('/preperso/preperso/upload', 'PrepersoController@upload');
    Route::patch('/preperso/preperso/update/{id}', 'PrepersoController@update');
    Route::get('/preperso/preperso/list', 'PrepersoController@list');
    Route::get('/preperso/preperso/list/pol', 'PrepersoController@pol');
    Route::get('/preperso/{tipe}', 'PrepersoController@index')->name('preperso.index');
    Route::get('/preperso/upload/log', 'PrepersoController@log')->name('upload_log');
    Route::post('/preperso/upload/log', 'PrepersoController@proseslog')->name('proses_log');
    
    //record	
    Route::post('/record/record/simpan_sementara', 'RecordController@simpan_sementara');
    Route::get('/record/record/tbl_laporan_sementara/{operator}/{tipe}', 'RecordController@tbl_laporan_sementara');
    Route::get('/record/record/tbl_laporan/edit/{operator}/{tanggal}', 'RecordController@edit');
    Route::get('/record/record/tbl_laporan/{operator}/{tanggal}/{tipe}', 'RecordController@tbl_laporan');    
    Route::delete('/record/record/{id}', 'RecordController@hapus');
    Route::post('/record/record/upload', 'RecordController@upload');
    Route::patch('/record/record/update/{id}', 'RecordController@update');
    Route::get('/record/record/list/pol', 'RecordController@pol');
    Route::get('/record/record/list/{tipe}', 'RecordController@list');    
    Route::get('/record/record/line/{line}/{id_periode}', 'RecordController@line');    
    Route::get('/record/{tipe}', 'RecordController@index')->name('record.index');	
    
    //other
    Route::get('/track/applet', 'AppletController@track_applet')->name('track_applet');
    Route::get('/track/applet/{uid}', 'AppletController@proses_track_applet');
    Route::get('/track/preperso', 'PrepersoController@track_preperso')->name('track_preperso');
    Route::get('/track/preperso/{uid}', 'PrepersoController@proses_track_preperso');
    Route::get('/track/job', 'AdminController@track_job')->name('track_job');
    Route::get('/track/track/job/{iner}/{tipe}', 'AdminController@proses_track_job');
    
    Route::get('/monitoring', 'AdminController@monitoring')->name('monitoring');
    Route::get('/resume/laporan/{tanggal}/{tanggal_akhir}/{shift}', 'AdminController@resume_laporan');
    Route::get('/bar/preperso/{tanggal}/{tanggal_akhir}/{shift}', 'AdminController@bar_preperso');
    Route::get('/bar/record/{tanggal}/{tanggal_akhir}/{shift}', 'AdminController@bar_record');
    Route::get('/bar/applet/{tanggal}/{tanggal_akhir}/{shift}', 'AdminController@bar_applet');
    Route::get('/bandinglog', 'AdminController@bandinglog')->name('banding.log');
    Route::get('/bandinglog/{tipe}/{iner}', 'AdminController@logbanding');
    Route::post('/log/simpan', 'AdminController@simpanlog');
    Route::get( '/lihatlaporan/{tipe}/{tanggal}/{tanggal_akhir}/{operator}', 'AdminController@lihat_laporan');
    Route::get('/rekapitulasi','AdminController@rekapitulasi')->name('rekapitulasi');
    Route::get('/rekapitulasi/{id_periode}', 'AdminController@prosesrekapitulasi');
    Route::get('/resume_sam', 'AdminController@resume_sam')->name('resume_sam');    
    
});


// Route::get('/chats','ChatsController@index');
// Route::get('/messages','ChatsController@fetchMessages');
// Route::post('/messages','ChatsController@sendMessage');