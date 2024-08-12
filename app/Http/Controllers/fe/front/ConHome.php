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
            ->paginate(12);
        $get_kategori = DB::table('tbl_kategori')->get();
        return view('frontend.pages.home', compact('get_postingan', 'get_kategori'));
    }

    public function kategori()
    {
        $get_kategori = DB::table('tbl_kategori')->get();
        return view('frontend.pages.kategori', compact('get_kategori'));
    }

    public function tentang()
    {
        $get_profile = DB::table('tbl_profile')->first();
        return view('frontend.pages.tentang', compact('get_profile'));
    }

    public function act_send_message(Request $request)
    {
        $validasi = $this->validate($request, [
            'nm_lengkap' => 'required|min:3|max:30',
            'email'      => 'required|min:4|max:30',
            'pesan'      => 'required|min:3|max:255',
        ]);
        $data_add = array(
            'nm_lengkap' => $request->nm_lengkap,
            'email'      => $request->email,
            'pesan'      => $request->pesan
        );
        if ($validasi) {
            $add_pesan = DB::table('tbl_pesan')->insert($data_add);
            return redirect()->back()->with('success', 'Pesan Anda Berhasil Terkirim!');
        }
    }
}
