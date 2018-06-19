<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
        dd('đd');
        return view('admin.dashboard.dashboard');//->with(compact('breadcrumbs'));
    }
}
