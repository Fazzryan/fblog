<?php

namespace App\Http\Controllers\fe\front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

use function Laravel\Prompts\select;

class ConHome extends Controller
{
    public function pecah_string($string)
    {
        $explode = explode('-', $string);
        $join = join(" ", $explode);
        $nama = ucwords($join);

        return $nama;
    }

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

    public function detail_postingan($slug_kategori, $slug)
    {
        $nama_title = $this->pecah_string($slug);
        $nama_slug  = $this->pecah_string($slug_kategori);

        $get_postingan = DB::table('tbl_postingan')
            ->join('tbl_user', 'tbl_postingan.id_user', '=', 'tbl_user.id')
            ->join('tbl_kategori', 'tbl_postingan.id_kategori', '=', 'tbl_kategori.id')
            ->select('tbl_postingan.*', 'tbl_user.username', 'tbl_kategori.slug_kategori', 'tbl_kategori.nm_kategori')
            ->where('tbl_postingan.slug', $slug)
            ->first();

        $get_postingan_terbaru = DB::table('tbl_postingan')
            ->join('tbl_user', 'tbl_postingan.id_user', '=', 'tbl_user.id')
            ->join('tbl_kategori', 'tbl_postingan.id_kategori', '=', 'tbl_kategori.id')
            ->select('tbl_postingan.*', 'tbl_user.username', 'tbl_kategori.slug_kategori', 'tbl_kategori.nm_kategori')
            ->orderBy('tbl_postingan.tgl_dibuat', 'desc')
            ->get();
        $get_kategori = DB::table('tbl_kategori')->get();

        return view('frontend.pages.detail_postingan', compact('get_postingan', 'get_postingan_terbaru', 'get_kategori', 'nama_title', 'nama_slug'));
    }
    // ---------------------------------------------
    // Action Kategori
    // ---------------------------------------------
    public function kategori()
    {
        $get_kategori = DB::table('tbl_kategori')->get();
        return view('frontend.pages.kategori', compact('get_kategori'));
    }

    public function nm_kategori($nm_kategori)
    {
        $nama_kategori = $this->pecah_string($nm_kategori);

        $get_postingan = DB::table('tbl_postingan')
            ->join('tbl_user', 'tbl_postingan.id_user', '=', 'tbl_user.id')
            ->join('tbl_kategori', 'tbl_postingan.id_kategori', '=', 'tbl_kategori.id')
            ->select('tbl_postingan.*', 'tbl_user.username', 'tbl_kategori.slug_kategori', 'tbl_kategori.nm_kategori')
            ->where('tbl_kategori.slug_kategori', $nm_kategori)
            ->get();

        $get_kategori = DB::table('tbl_kategori')->get();
        $get_nm_kategori = DB::table('tbl_kategori')->where('slug_kategori', $nm_kategori)->get();

        return view('frontend.pages.postingan_kategori', compact('get_postingan', 'get_kategori', 'get_nm_kategori', 'nama_kategori'));
    }

    // ---------------------------------------------
    // Action tentang
    // ---------------------------------------------
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
