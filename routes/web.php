<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\be\auth\ConAuth;
use App\Http\Controllers\be\dashboard\ConDashboard;
use App\Http\Controllers\be\kategori\ConKategori;
use App\Http\Controllers\be\pesan\ConPesan;
use App\Http\Controllers\be\postingan\ConPostingan;
use App\Http\Controllers\be\profile\ConProfile;
use App\Http\Controllers\fe\front\ConHome;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['as' => 'fe.'],  function () {

    //--------------------------------------------------------------------------
    //  Routes Home
    //--------------------------------------------------------------------------
    Route::get('/', [ConHome::class, 'home'])->name('home');
    Route::get('/blog/{nm_kategori}/{detail_postingan}', [ConHome::class, 'detail_postingan'])->name('detail_postingan');

    //--------------------------------------------------------------------------
    //  Routes Kategori
    //--------------------------------------------------------------------------
    Route::group(['as' => 'kategori.', 'prefix' => '/'],  function () {
        Route::get('/kategori', [ConHome::class, 'kategori'])->name('list');
        Route::get('/kategori/{nm_kategori}', [ConHome::class, 'nm_kategori'])->name('nm_kategori');
    });

    //--------------------------------------------------------------------------
    //  Routes About
    //--------------------------------------------------------------------------
    Route::group(['as' => 'tentang.', 'prefix' => '/'],  function () {
        Route::get('/tentang', [ConHome::class, 'tentang'])->name('list');
        Route::post('/tentang/act_send_message', [ConHome::class, 'act_send_message'])->name('act_send_message');
    });
});



Route::get('login', [ConAuth::class, 'index'])->name('login');

Route::group(['as' => 'auth.', 'prefix' => '/auth'],  function () {
    Route::post('/act_login', [ConAuth::class, 'act_login'])->name('act_login');
    Route::get('/act_logout', [ConAuth::class, 'act_logout'])->name('act_logout');
});

Route::group(['as' => 'be.', 'prefix' => '/u', 'middleware' => 'CekSession'],  function () {

    //--------------------------------------------------------------------------
    //  Routes Dashboard
    //--------------------------------------------------------------------------
    Route::get('/dashboard', [ConDashboard::class, 'index'])->name('dashboard');


    //--------------------------------------------------------------------------
    //  Routes Postingan
    //--------------------------------------------------------------------------
    Route::group(['as' => 'postingan.', 'prefix' => '/postingan'],  function () {
        Route::get('/list', [ConPostingan::class, 'index'])->name('list');
        Route::get('/add', [ConPostingan::class, 'add'])->name('add');
        Route::get('/edit/{id?}', [ConPostingan::class, 'edit'])->name('edit');

        // Action Add
        Route::post('/act_add_postingan', [ConPostingan::class, 'act_add_postingan'])->name('act_add_postingan');
        // Action Edit
        Route::post('/act_edit_postingan', [ConPostingan::class, 'act_edit_postingan'])->name('act_edit_postingan');
        // Action Delete
        Route::post('/act_delete_postingan', [ConPostingan::class, 'act_delete_postingan'])->name('act_delete_postingan');
    });

    //--------------------------------------------------------------------------
    //  Routes Kategori
    //--------------------------------------------------------------------------
    Route::group(['as' => 'kategori.', 'prefix' => '/kategori'],  function () {
        Route::get('/list', [ConKategori::class, 'index'])->name('list');

        // Action Add
        Route::post('/act_add_kategori', [ConKategori::class, 'act_add_kategori'])->name('act_add_kategori');
        // Action Edit
        Route::post('/act_edit_kategori', [ConKategori::class, 'act_edit_kategori'])->name('act_edit_kategori');
        // Action Delete
        Route::post('/act_delete_kategori', [ConKategori::class, 'act_delete_kategori'])->name('act_delete_kategori');
    });

    //--------------------------------------------------------------------------
    //  Routes Pesan
    //--------------------------------------------------------------------------
    Route::group(['as' => 'pesan.', 'prefix' => '/pesan'],  function () {
        Route::get('/list', [ConPesan::class, 'index'])->name('list');
        // Action Add
        Route::post('/act_add_pesan', [ConPesan::class, 'act_add_pesan'])->name('act_add_pesan');
        // Action Delete
        Route::post('/act_delete_pesan', [ConPesan::class, 'act_delete_pesan'])->name('act_delete_pesan');
    });

    //--------------------------------------------------------------------------
    //  Routes Profile
    //--------------------------------------------------------------------------
    Route::group(['as' => 'profile.', 'prefix' => '/profile'],  function () {
        Route::get('/', [ConProfile::class, 'index'])->name('list');

        // Action Edit
        Route::post('/act_edit_auth', [ConProfile::class, 'act_edit_auth'])->name('act_edit_auth');
        Route::post('/act_edit_profile', [ConProfile::class, 'act_edit_profile'])->name('act_edit_profile');
        // Action Delete
        Route::post('/act_delete_pesan', [ConProfile::class, 'act_delete_pesan'])->name('act_delete_pesan');
    });
});
