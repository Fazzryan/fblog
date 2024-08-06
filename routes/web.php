<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\be\auth\ConAuth;
use App\Http\Controllers\be\dashboard\ConDashboard;
use App\Http\Controllers\be\kategori\ConKategori;
use App\Http\Controllers\be\pesan\ConPesan;
use App\Http\Controllers\be\postingan\ConPostingan;

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

Route::get('/', function () {
    return view('backend.pages.dashboard.index');
});

Route::group(['as' => 'auth.', 'prefix' => '/auth'],  function () {
    Route::post('/act_login', [ConAuth::class, 'act_login'])->name('act.login');
    Route::get('/act_logout', [ConAuth::class, 'act_logout'])->name('act.logout');
});

Route::group(['as' => 'be.', 'prefix' => '/u'],  function () {

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
    });
});
