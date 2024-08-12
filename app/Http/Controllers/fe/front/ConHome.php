<?php

namespace App\Http\Controllers\fe\front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class ConHome extends Controller
{
    public function home()
    {
        $get_postingan = DB::table('tbl_postingan')
            ->join('tbl_user', 'tbl_postingan.id_user', '=', 'tbl_user.id')
            ->join('tbl_kategori', 'tbl_postingan.id_kategori', '=', 'tbl_kategori.id')
            ->select('tbl_postingan.*', 'tbl_user.username', 'tbl_kategori.slug_kategori', 'tbl_kategori.nm_kategori')
            ->paginate(1);
        $get_kategori = DB::table('tbl_kategori')->get();
        return view('frontend.pages.home', compact('get_postingan', 'get_kategori'));
    }

    public function kategori()
    {

        $get_kategori = DB::table('tbl_kategori')->get();
        return view('frontend.pages.home', compact('get_kategori'));
    }
}
