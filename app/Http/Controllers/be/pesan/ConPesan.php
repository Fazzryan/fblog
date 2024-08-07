<?php

namespace App\Http\Controllers\be\pesan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConPesan extends Controller
{
    public function index()
    {
        $get_pesan = DB::table('tbl_pesan')->get();
        return view('backend.pages.pesan.index', compact('get_pesan'));
    }

    public function act_delete_pesan(Request $request)
    {
        $id_pesan = $request->id_pesan;
        if ($id_pesan == null) {
            return redirect()->back()->with('failed', 'Data Pesan : Tidak Boleh Kosong!');
        } else {
            // cek apakah id teradaftar atau tidak
            $cek_id = DB::table('tbl_pesan')->where('id', $id_pesan)->count();
            if ($cek_id > 0) {
                // jika terdaftar maka
                // Cek relasi ke postingan
                $del_pesan = DB::table('tbl_pesan')->where('id', $id_pesan)->delete();
                return redirect()->back()->with('success', 'Data Pesan : Berhasil dihapus!');
            } else {
                // jika tidak maka
                return redirect()->back()->with('failed', 'Data Pesan : Tidak Ditemukan!');
            }
        }
    }
}
