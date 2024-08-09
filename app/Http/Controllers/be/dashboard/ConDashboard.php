<?php

namespace App\Http\Controllers\be\dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConDashboard extends Controller
{
    public function index()
    {
        $get_postingan = DB::table('tbl_postingan')
            ->join('tbl_kategori', 'tbl_postingan.id_kategori', '=', 'tbl_kategori.id')
            ->select('tbl_postingan.*', 'tbl_kategori.nm_kategori')
            ->limit(5)->orderBy('id', 'asc')->get();
        $get_kategori = DB::table('tbl_kategori')->limit(5)->orderBy('id', 'asc')->get();
        $get_pesan = DB::table('tbl_pesan')->limit(5)->orderBy('id', 'asc')->get();

        $jml_postingan = DB::table('tbl_postingan')->count();
        $jml_kategori  = DB::table('tbl_kategori')->count();
        $jml_pesan     = DB::table('tbl_pesan')->count();

        return view(
            'backend.pages.dashboard.index',
            compact(
                'get_postingan',
                'get_kategori',
                'get_pesan',
                'jml_postingan',
                'jml_kategori',
                'jml_pesan'
            )
        );
    }
}
