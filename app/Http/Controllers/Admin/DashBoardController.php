<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard.dashboard');//->with(compact('breadcrumbs'));
    }
}
