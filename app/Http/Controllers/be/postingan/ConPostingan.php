<?php

namespace App\Http\Controllers\be\postingan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConPostingan extends Controller
{
    public function index()
    {
        $get_postingan = DB::table('tbl_postingan')
            ->join('tbl_kategori', 'tbl_postingan.id_kategori', '=', 'tbl_kategori.id')
            ->select('tbl_postingan.*', 'tbl_kategori.nm_kategori')
            ->orderBy('tbl_postingan.tgl_dibuat', 'asc')
            ->get();
        return view('backend.pages.postingan.index', compact('get_postingan'));
    }
    public function add()
    {
        $get_kategori = DB::table('tbl_kategori')->get();
        return view('backend.pages.postingan.add_postingan', compact('get_kategori'));
    }
    public function edit($id)
    {
        $id_postingan = base64_decode($id);
        $get_postingan = DB::table('tbl_postingan')->where('id', $id_postingan)->first();
        $get_kategori = DB::table('tbl_kategori')->get();
        return view('backend.pages.postingan.edt_postingan', compact('get_postingan', 'get_kategori'));
    }

    //fungsi add
    public function act_add_postingan(Request $request)
    {
        $title       = $request->title;
        $id_user     = $request->id_user;
        $id_kategori = $request->id_kategori;
        $slug        = $request->slug;
        $content     = $request->content;
        $image       = $request->image;
        // dd($image);
        //Validasi
        $messages = array(
            'required' => ':attribute Harus Di isi!',
            'min'      => ':attribute Minimal 3 Karakter!',
            'max'      => ':attribute Maksimal 50 Karakter!'
        );
        $attribute = array(
            'title'       => 'Nama Kategori',
            'id_user'     => 'ID User',
            'id_kategori' => 'ID Kategori',
            'slug'        => 'Slug',
            'content'     => 'Konten',
            'image'       => 'Gambar'
        );
        $credentials_non_image = array(
            'title'       => 'required|min:3|max:100',
            'id_user'     => 'required',
            'id_kategori' => 'required',
            'slug'        => 'required|min:3|max:100',
            'content'     => 'required',
        );
        $credentials_with_image = array_merge($credentials_non_image, [
            'image'       => 'required',
        ]);

        $data_add_non_image = array(
            'title'       => $title,
            'id_user'     => $id_user,
            'id_kategori' => $id_kategori,
            'slug'        => $slug,
            'content'     => $content,
        );

        if ($image == null) {
            // jika gambarnya kosong maka Terima Data request kemudian validasi dulu
            $validasi = $this->validate($request, $credentials_non_image, $messages, $attribute);
            if ($validasi) {
                $cek_title = DB::table('tbl_postingan')->where('title', $title)->count();
                if ($cek_title > 0) {
                    return redirect()->back()->with('failed', 'Data Postingan : Judul Postingan Sudah Ada!')->withInput();
                } else {

                    $query_add = DB::table('tbl_postingan')->insert($data_add_non_image);

                    return redirect()->route('be.postingan.list')->with('success', 'Postingan : berhasil ditambahkan!');
                }
            }
            // return redirect()->back()->with('failed', 'Data Postingan : Gambar Harus Diisi!')->withInput();
        } else {
            $gambar = $request->file('image');
            $validasi = $this->validate($request, $credentials_with_image, $messages, $attribute);
            if ($validasi) {
                // cek apakah judul tersedia 
                $cek_title = DB::table('tbl_postingan')->where('title', $title)->count();
                if ($cek_title > 0) {
                    return redirect()->back()->with('failed', 'Data Postingan : Judul Postingan Sudah Ada!')->withInput();
                } else {
                    $ori_ekstensiGambar = $gambar->getClientOriginalExtension();
                    $ori_sizeGambar     = number_format($gambar->getSize() / 1024, 0); //KB
                    $size_gambar        = str_replace(',', '', $ori_sizeGambar);

                    if (($ori_ekstensiGambar == "jpg") || ($ori_ekstensiGambar == "JPG") || ($ori_ekstensiGambar == "png") || ($ori_ekstensiGambar == "PNG")) {
                        if (($size_gambar < 3) || ($size_gambar > 2000)) {
                            return redirect()->back()->with('failed', 'Ukuran Gambar Maksimal 2mb, Minimal 10kb!');
                        } else {

                            //package update
                            $nama_gambar = "gambar-" . rand() . "." . $ori_ekstensiGambar;
                            $data_update_with_image = array_merge($data_add_non_image, array('image' => $nama_gambar));

                            //Unlink Logo
                            // $getLogo = DB::table('tko_pengaturan_aplikasi')->where('id', $id)->first()->logo_perusahaan;
                            // unlink(public_path('/assets/toko/be/images/icons/' . $getLogo));

                            $update = DB::table('tbl_postingan')->insert($data_update_with_image);

                            //compress Logo
                            // $path      = $logo->getRealPath();
                            // $destinasi = public_path('/assets/toko/be/images/icons/') . $nama_logo;
                            // $conImages = new ConImages;
                            // $thumbnail = $conImages->compress_image($path, $destinasi, 75);

                            $gambar->move(public_path('/assets/be/images/icons/'), $nama_gambar);

                            return redirect()->route('be.postingan.list')->with('success', 'Postingan : berhasil ditambahkan!');
                        }
                    } else {
                        return redirect()->back()->with('failed', 'Ekstensi foto harus .jpg atau .png!');
                    }
                }
            }
        }
    }

    //fungsi edit
    public function act_edit_postingan(Request $request)
    {
        $id_postingan = $request->id_postingan;
        $title        = $request->title;
        $id_user      = $request->id_user;
        $id_kategori  = $request->id_kategori;
        $slug         = $request->slug;
        $content      = $request->content;
        $image        = $request->image;
        // dd($title);
        //Validasi
        $messages = array(
            'required' => ':attribute Harus Di isi!',
            'min'      => ':attribute Minimal 3 Karakter!',
            'max'      => ':attribute Maksimal 50 Karakter!'
        );
        $attribute = array(
            'title'       => 'Nama Kategori',
            'id_user'     => 'ID User',
            'id_kategori' => 'ID Kategori',
            'slug'        => 'Slug',
            'content'     => 'Konten',
            'image'       => 'Gambar'
        );
        $credentials_non_image = array(
            'title'       => 'required|min:3|max:100',
            'id_user'     => 'required',
            'id_kategori' => 'required',
            'slug'        => 'required|min:3|max:100',
            'content'     => 'required',
        );
        $credentials_with_image = array_merge($credentials_non_image, [
            'image'       => 'required',
        ]);

        $data_add_non_image = array(
            'title'       => $title,
            'id_user'     => $id_user,
            'id_kategori' => $id_kategori,
            'slug'        => $slug,
            'content'     => $content,
        );

        if ($image == null) {
            // jika gambarnya kosong maka Terima Data request kemudian validasi dulu
            $validasi = $this->validate($request, $credentials_non_image, $messages, $attribute);
            if ($validasi) {
                // cek perubahan data
                $cek_perubahan = DB::table('tbl_postingan')
                    ->where('id', $id_postingan)
                    ->where('id_user', $id_user)
                    ->where('title', $title)
                    ->where('id_kategori', $id_kategori)
                    ->where('content', $content)->count();
                if ($cek_perubahan > 0) {
                    return redirect()->route('be.postingan.list')->with('failed', 'Data Postingan : tidak ada perubahan!');
                } else {
                    // cek apakah data tersedia 
                    $cek_data = DB::table('tbl_postingan')->where('id', $id_postingan)->where('title', $title)->count();
                    if ($cek_data > 0) {
                        $data_add = array(
                            'id_user'     => $id_user,
                            'id_kategori' => $id_kategori,
                            'slug'        => $slug,
                            'content'     => $content,
                        );
                        $query_update = DB::table('tbl_postingan')->where('id', $id_postingan)->update($data_add);
                        return redirect()->route('be.postingan.list')->with('success', 'Data Postingan : berhasil diubah!');
                    } else {
                        // cek nama apakah tersedia
                        $cek_title = DB::table('tbl_postingan')->where('title', $title)->count();
                        if ($cek_title > 0) {
                            return redirect()->back()->with('failed', 'Data Postingan : Judul Postingan Sudah Ada!')->withInput();
                        } else {
                            $query_update = DB::table('tbl_postingan')->where('id', $id_postingan)->update($data_add_non_image);
                            return redirect()->route('be.postingan.list')->with('success', 'Data Postingan : berhasil diubah!');
                        }
                    }
                }
            }
        } else {
            $gambar = $request->file('image');
            $validasi = $this->validate($request, $credentials_with_image, $messages, $attribute);
            if ($validasi) {
                $ori_ekstensiGambar = $gambar->getClientOriginalExtension();
                $ori_sizeGambar     = number_format($gambar->getSize() / 1024, 0); //KB
                $size_gambar        = str_replace(',', '', $ori_sizeGambar);

                if (($ori_ekstensiGambar == "jpg") || ($ori_ekstensiGambar == "JPG") || ($ori_ekstensiGambar == "png") || ($ori_ekstensiGambar == "PNG")) {
                    if (($size_gambar < 3) || ($size_gambar > 2000)) {
                        return redirect()->back()->with('failed', 'Ukuran Gambar Maksimal 2mb, Minimal 10kb!');
                    } else {
                        //package update
                        $nama_gambar = "gambar-" . rand() . "." . $ori_ekstensiGambar;
                        $data_update_with_image = array_merge($data_add_non_image, array('image' => $nama_gambar));

                        // cek apakah data tersedia 
                        $cek_title = DB::table('tbl_postingan')->where('id', $id_postingan)->where('title', $title)->count();
                        if ($cek_title > 0) {
                            $data_update = array(
                                'id_user'     => $id_user,
                                'id_kategori' => $id_kategori,
                                'slug'        => $slug,
                                'content'     => $content,
                            );
                            $data_update_with_image_2 = array_merge($data_update, array('image' => $nama_gambar));
                            //Unlink Logo
                            $get_gambar = DB::table('tbl_postingan')->where('id', $id_postingan)->first()->image;
                            if ($get_gambar > 0) {
                                unlink(public_path('/assets/be/images/icons/' . $get_gambar));
                            }
                            $query_update = DB::table('tbl_postingan')->where('id', $id_postingan)->update($data_update_with_image_2);
                            $gambar->move(public_path('/assets/be/images/icons/'), $nama_gambar);
                            return redirect()->route('be.postingan.list')->with('success', 'Postingan : berhasil diubah!');
                        } else {
                            // cek nama apakah tersedia
                            $cek_title = DB::table('tbl_postingan')->where('title', $title)->count();
                            if ($cek_title > 0) {
                                return redirect()->back()->with('failed', 'Data Postingan : Judul Postingan Sudah Ada!')->withInput();
                            } else {
                                //Unlink Logo
                                $get_gambar = DB::table('tbl_postingan')->where('id', $id_postingan)->first()->image;
                                if ($get_gambar > 0) {
                                    unlink(public_path('/assets/be/images/icons/' . $get_gambar));
                                }
                                $query_update = DB::table('tbl_postingan')->where('id', $id_postingan)->update($data_update_with_image);
                                $gambar->move(public_path('/assets/be/images/icons/'), $nama_gambar);
                                return redirect()->route('be.postingan.list')->with('success', 'Data Postingan : berhasil diubah!');
                            }
                        }
                    }
                } else {
                    return redirect()->back()->with('failed', 'Ekstensi foto harus .jpg atau .png!');
                }
            }
        }
    }

    public function act_delete_postingan(Request $request)
    {
        $id_postingan = $request->id_postingan;
        if ($id_postingan == null) {
            return redirect()->back()->with('failed', 'Data Postingan : Tidak Ditemukan!');
        } else {
            // cek apakah id teradaftar atau tidak
            $cek_id = DB::table('tbl_postingan')->where('id', $id_postingan)->count();
            if ($cek_id > 0) {
                //   Unlink gambar
                // cek apakah gambar ada didalam database
                $get_img = DB::table('tbl_postingan')->where('id', $id_postingan)->first()->image;
                if ($get_img > 0) {
                    // jika ada maka hapus gambar nya
                    unlink(public_path('/assets/be/images/icons/' . $get_img));
                }

                $del_postingan = DB::table('tbl_postingan')->where('id', $id_postingan)->delete();
                return redirect()->back()->with('success', 'Data Postingan : Berhasil dihapus!');
            } else {
                // jika tidak maka
                return redirect()->back()->with('failed', 'Data Postingan : Tidak Ditemukan!');
            }
        }
    }
}
