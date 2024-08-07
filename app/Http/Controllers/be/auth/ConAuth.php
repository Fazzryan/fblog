<?php

namespace App\Http\Controllers\be\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ConAuth extends Controller
{
    public function index()
    {
        $cek_session_login = $this->cek_session();
        if ($cek_session_login == "true") {
            // Toastr::success('Anda sudah login!', 'maaf');
            return redirect()->route('be.dashboard')->with('success', 'Anda sudah login!');
        } else {

            return view('backend.pages.auth.login');
        }
    }
    public function act_login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        //custom notif validasi
        $messages = array(
            'required' => ':attribute Harus Di Isi!',
            'min'      => ':attribute Minimal 6 Karakter!',
            'max'      => ':attribute Maksimal 50 Karakter!'
        );
        $attribute = array(
            'username' => 'Username',
            'password' => 'Password',
        );
        $credentials = array(
            'username' => 'required|max:50',
            'password' => 'required|min:6|max:50',
        );
        $validasi = $this->validate($request, $credentials, $messages, $attribute);
        if ($validasi) {
            $pass = md5($password);
            // cek apakah username dan password ada
            $query_login = DB::table('tbl_user')
                ->where('username', $username)
                ->where('password', $pass);
            $cek = $query_login->count();

            if ($cek > 0) {
                $users = $query_login->first();
                // jika ada maka buatkan session dan login
                $user_session = [
                    'id_user' => $users->id,
                    'username' => $users->username,
                ];
                Session::put('user_session', $user_session);
                Session::put('login', TRUE);
                // Toastr::success($msg, 'Berhasil');
                return redirect()->route('be.dashboard')->with('success', "Berhasil Login");
            } else {
                // Toastr::error('message', 'Gagal');
                return redirect()->back()->with('failed', 'Username atau Passwod Salah!');
            }
        }
    }

    public function act_logout()
    {
        Session::flush();
        // Toastr::error('Kamu Keluar :(', 'Berhasil');
        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }

    public function cek_session()
    {
        if (Session::has('login')) {
            $get_login = "true";
        } else {
            $get_login = "false";
        }
        return $get_login;
    }
}
