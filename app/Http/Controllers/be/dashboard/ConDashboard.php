<?php

namespace App\Http\Controllers\be\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConDashboard extends Controller
{
    public function index()
    {
        return view('backend.pages.dashboard.index');
    }
}
