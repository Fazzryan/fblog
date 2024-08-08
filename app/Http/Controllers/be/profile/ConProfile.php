<?php

namespace App\Http\Controllers\be\profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;

class ConProfile extends Controller
{
    public function index()
    {
        $id_user = session()->get('user_session')['id_user'];
        $profile = DB::table('tbl_profile')
            ->join('tbl_user', 'tbl_profile.id_user', '=', 'tbl_user.id')
            ->select('tbl_profile.*', 'tbl_user.username', 'tbl_user.password', 'tbl_user.pass')
            ->where('id_user', $id_user)->first();
        return view('backend.pages.profile.index', compact('profile'));
    }


    public function act_edit_profile(Request $request)
    {
        $id_user     = $request->id_user;
        $nm_depan    = ucwords(strtolower($request->nm_depan));
        $nm_belakang = ucwords(strtolower($request->nm_belakang));
        $youtube     = $request->youtube;
        $instagram   = $request->instagram;
        $github      = $request->github;

        // dd($id_user . '-' . $nm_depan . '-' . $nm_belakang . '-' . $youtube, '-', $instagram, '-', $github);

        // validasi
        $messages = array(
            'required' => ':attribute Harus Di isi!',
            'min'      => ':attribute Minimal 5 Karakter!',
            'max'      => ':attribute Maksimal 50 Karakter!'
        );
        $attribute = array(
            'nm_depan'    => 'Username',
            'nm_belakang' => 'Username',
            'youtube'     => 'Youtube',
            'instagram'   => 'Instagram',
            'github'      => 'Github',
        );
        $credentials = array(
            'nm_depan'    => 'required|min:3|max:50',
            'nm_belakang' => 'required|min:3|max:50',
            'nm_belakang' => 'required|min:3|max:50',
            'youtube'     => 'required',
            'instagram'   => 'required',
            'github'      => 'required',
        );
        $data_update = array(
            'nm_depan'    => $nm_depan,
            'nm_belakang' => $nm_belakang,
            'youtube'     => $youtube,
            'instagram'   => $instagram,
            'github'      => $github,
        );
        $validasi = $this->validate($request, $credentials, $messages, $attribute);
        if ($validasi) {
            // cek id user
            $cek_id_user = DB::table('tbl_profile')->where('id_user', $id_user)->count();
            if ($cek_id_user > 0) {
                // cek perubahan
                $cek_perubahan = DB::table('tbl_profile')
                    ->where('id', $id_user)
                    ->where('nm_depan', $nm_depan)
                    ->where('nm_belakang', $nm_belakang)
                    ->where('youtube', $youtube)
                    ->where('instagram', $instagram)
                    ->where('github', $github)->count();
                if ($cek_perubahan > 0) {
                    return redirect()->back()->with('failed', 'Data Profile : Tidak ada perubahan!');
                } else {
                    // cek apakah data tersedia
                    $cek_id_nm_depan = DB::table('tbl_profile')->where('id_user', $id_user)->where('nm_depan', $nm_depan)->count();
                    if ($cek_id_nm_depan > 0) {
                        $data_update = array(
                            'nm_belakang' => $nm_belakang,
                            'youtube'     => $youtube,
                            'instagram'   => $instagram,
                            'github'      => $github,
                        );
                        $query_update = DB::table('tbl_profile')->where('id', $id_user)->update($data_update);
                        return redirect()->back()->with('success', 'Data Profile : Berhasil Diubah!');
                    } else {
                        // cek nama depan apakah tersedia
                        $cek_nm_depan = DB::table('tbl_profile')->where('nm_depan', $nm_depan)->count();
                        if ($cek_nm_depan > 0) {
                            return redirect()->back()->with('failed', 'Nama Depan Sudah Dipakai!');
                        } else {
                            $query_update = DB::table('tbl_profile')->where('id_user', $id_user)->update($data_update);
                            return redirect()->back()
                                ->with('success', 'Data User : Berhasil Diubah!');
                        }
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'Data User : Tidak Ditemukan!');
            }
        }
    }
    public function act_edit_auth(Request $request)
    {
        $id_user = $request->id_user;
        $username = $request->username;
        $pass = $request->pass;
        $password = md5($request->pass);

        // dd($id_user . '-' . $username . '-' . $pass . '-' . $password);

        // validasi
        $messages = array(
            'required' => ':attribute Harus Di isi!',
            'min'      => ':attribute Minimal 5 Karakter!',
            'max'      => ':attribute Maksimal 50 Karakter!'
        );
        $attribute = array(
            'username' => 'Username',
            'pass' => 'Password',
        );
        $credentials = array(
            'username' => 'required|min:3|max:50',
            'pass' => 'required|min:5|max:50',
        );
        $data_update = array(
            'username' => $username,
            'password' => $password,
            'pass' => $pass,
        );
        $validasi = $this->validate($request, $credentials, $messages, $attribute);
        if ($validasi) {
            // cek id user
            $cek_id_user = DB::table('tbl_user')->where('id', $id_user)->count();
            if ($cek_id_user > 0) {
                // cek perubahan
                $cek_perubahan = DB::table('tbl_user')
                    ->where('id', $id_user)
                    ->where('username', $username)
                    ->where('password', $password)->count();
                if ($cek_perubahan > 0) {
                    return redirect()->back()->with('failed', 'Data User : Tidak ada perubahan!');
                } else {
                    // cek apakah data tersedia
                    $cek_id_username = DB::table('tbl_user')->where('id', $id_user)->where('username', $username)->count();
                    if ($cek_id_username > 0) {
                        $data_update = array(
                            'password' => $password,
                            'pass' => $pass,
                        );
                        $query_update = DB::table('tbl_user')->where('id', $id_user)->update($data_update);
                        return redirect()->back()->with('success', 'Data User : Berhasil Diubah!');
                    } else {
                        // cek username apakah tersedia
                        $cek_username = DB::table('tbl_user')->where('username', $username)->count();
                        if ($cek_username > 0) {
                            return redirect()->back()->with('failed', 'Username Sudah Dipakai!');
                        } else {
                            $query_update = DB::table('tbl_user')->where('id', $id_user)->update($data_update);
                            return redirect()->back()
                                ->with('success', 'Data User : Berhasil Diubah!');
                        }
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'Data User : Tidak Ditemukan!');
            }
        }
    }
}
