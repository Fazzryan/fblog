<?php

namespace App\Http\Controllers\be\kategori;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConKategori extends Controller
{
    public function index()
    {
        $get_kategori = DB::table('tbl_kategori')
            ->leftJoin('tbl_postingan', 'tbl_kategori.id', '=', 'tbl_postingan.id_kategori')
            ->select('tbl_kategori.*', DB::raw('COALESCE(COUNT(tbl_postingan.id), 0) as jml'))
            ->groupBy('tbl_kategori.id', 'tbl_kategori.nm_kategori', 'tbl_kategori.slug', 'tbl_kategori.tgl_dibuat', 'tbl_kategori.tgl_diubah')
            ->get();

        return view('backend.pages.kategori.index', compact('get_kategori'));
    }


    public function act_add_kategori(Request $request)
    {
        $nm_kategori   = ucwords(strtolower($request->nm_kategori));
        $slug          = $request->slug;

        //Validasi
        $messages = array(
            'required' => ':attribute Harus Di isi!',
            'min'      => ':attribute Minimal 3 Karakter!',
            'max'      => ':attribute Maksimal 50 Karakter!'
        );
        $attribute = array(
            'nm_kategori' => 'Nama Kategori',
            'slug'        => 'Slug',
        );
        $credentials = array(
            'nm_kategori' => 'required|min:3|max:50',
            'slug'        => 'required|min:3|max:50',
        );
        $data_add = array(
            'nm_kategori' => $nm_kategori,
            'slug'        => $slug,
        );

        $validasi = $this->validate($request, $credentials, $messages, $attribute);
        if ($validasi) {
            // cek apakah kategori sudah ada
            $cek_nm_kategori = DB::table('tbl_kategori')->where('nm_kategori', $nm_kategori)->count();
            if ($cek_nm_kategori > 0) {
                return redirect()->back()->with('failed', 'Data Kategori : Sudah Ada!');
            } else {
                // jika kategori masih kosong maka insert data
                $query_add = DB::table('tbl_kategori')->insert($data_add);
                return redirect()->back()->with('success', 'Data Kategori : Berhasil Ditambahkan.');
            }
        }
    }

    public function act_edit_kategori(Request $request)
    {
        $id_kategori   = $request->id_kategori;
        $nm_kategori   = ucwords(strtolower($request->nm_kategori));
        $slug          = $request->slug;
        //Validasi
        $messages = array(
            'required' => ':attribute Harus Di isi!',
            'min'      => ':attribute Minimal 3 Karakter!',
            'max'      => ':attribute Maksimal 50 Karakter!'
        );
        $attribute = array(
            'nm_kategori' => 'Nama Kategori',
            'slug'        => 'Slug',
        );
        $credentials = array(
            'nm_kategori' => 'required|min:3|max:50',
            'slug'        => 'required|min:3|max:50',
        );

        $validasi = $this->validate($request, $credentials, $messages, $attribute);
        if ($validasi) {
            // cek apakah id terdaftar
            $cek_id = DB::table('tbl_kategori')->where('id', $id_kategori)->count();
            if ($cek_id > 0) {
                // cek perubahan
                $cek_perubahan = DB::table('tbl_kategori')
                    ->where('id', $id_kategori)
                    ->where('nm_kategori', $nm_kategori)->count();
                if ($cek_perubahan > 0) {
                    return redirect()->back()->with('failed', 'Data Kategori : Tidak ada perubahan!');
                } else {
                    // cek apakah id dan kategori sudah ada
                    $cek_nm_kategori = DB::table('tbl_kategori')->where('nm_kategori', $nm_kategori)->count();
                    if ($cek_nm_kategori > 0) {
                        return redirect()->back()->with('failed', 'Nama Kategori Sudah Ada!');
                    } else {
                        // jika kategori masih kosong maka insert data
                        $data_update = array(
                            'nm_kategori' => $nm_kategori,
                            'slug'        => $slug,
                        );
                        $query_update = DB::table('tbl_kategori')->where('id', $id_kategori)->update($data_update);
                        return redirect()->back()->with('success', 'Data Kategori : Berhasil Diubah!');
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'Data Kategori : Tidak ditemukan!');
            }
        }
    }

    public function act_delete_kategori(Request $request)
    {
        $id_kategori = $request->id_kategori;
        if ($id_kategori == null) {
            return redirect()->back()->with('failed', 'Data Kategori : Tidak Boleh Kosong!');
        } else {
            // cek apakah id teradaftar atau tidak
            $cek_id = DB::table('tbl_kategori')->where('id', $id_kategori)->count();
            if ($cek_id > 0) {
                // jika terdaftar maka
                // Cek relasi ke postingan
                $cek_relasi = DB::table('tbl_postingan')->where('id_kategori', $id_kategori)->count();
                if ($cek_relasi > 0) {
                    return redirect()->back()->with('failed', 'Data Kategori : Digunakan oleh salah satu postingan!');
                } else {
                    $del_kategori = DB::table('tbl_kategori')->where('id', $id_kategori)->delete();
                    return redirect()->back()->with('success', 'Data Kategori : Berhasil dihapus!');
                }
            } else {
                // jika tidak maka
                return redirect()->back()->with('failed', 'Data Kategori : Tidak Ditemukan!');
            }
        }
    }
}
