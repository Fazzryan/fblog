<?php

namespace App\Http\Controllers\be\pesan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConPesan extends Controller
{
    public function index()
    {
        return view('backend.pages.pesan.index');
    }
}
