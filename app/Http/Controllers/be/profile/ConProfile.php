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
            ->select('tbl_profile.*', 'tbl_user.username', 'tbl_user.password')
            ->where('id_user', $id_user)->first();
        return view('backend.pages.profile.index', compact('profile'));
    }
}
