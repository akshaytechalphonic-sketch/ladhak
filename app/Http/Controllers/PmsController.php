<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PmsController extends Controller
{
    public function dashboard()
    {
        return view('pms.dashboard');
    }

    public function projects()
    {
        return view('pms.projects.index');
    }

    public function board()
    {
        return view('pms.projects.board');
    }
    
    public function projectShow()
    {
        return view('pms.projects.show');
    }

    public function users()
    {
        return view('pms.users.index');
    }
}
