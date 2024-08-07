<?php

namespace App\Http\Controllers\be\pesan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ConPesan extends Controller
{
    public function index()
    {
        $get_pesan = DB::table('tbl_pesan')->get();
        return view('backend.pages.pesan.index', compact('get_pesan'));
    }

    public function act_add_pesan(Request $request)
    {
        $nm_lengkap = ucwords(strtolower($request->nm_lengkap));
        $email = $request->email;
        $pesan = $request->pesan;

        //Validasi
        $messages = array(
            'required' => ':attribute Harus Di isi!',
            'min'      => ':attribute Minimal 3 Karakter!',
            'max'      => ':attribute Maksimal 50 Karakter!'
        );
        $attribute = array(
            'nm_lengkap' => 'Nama Lengkap',
            'email'      => 'Slug',
        );
        $credentials = array(
            'nm_lengkap' => 'required|min:3|max:50',
            'email'      => 'required|min:3|max:50',
        );
        $data_add = array(
            'nm_lengkap' => $nm_lengkap,
            'email'      => $email,
        );
        $validasi = $this->validate($request, $credentials, $messages, $attribute);
        if ($validasi) {
            $query_add = DB::table('tbl_pesan')->insert($data_add);
            Toastr::success('message', 'Pesan Terikirim!');
            return redirect()->back();
            // ->with('success', 'Data Kategori : Berhasil Ditambahkan.');
        }
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
