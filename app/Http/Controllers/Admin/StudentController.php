<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\User;
use DB;
use Hash;

class StudentController extends Controller
{
    protected $_limit = 15;
    protected $_table = 'users_courses';
    protected $_table_courses = 'courses';

    public function __construct()
    {
        $this->_limit = env('LIMIT_SHOW_LIST', $this->_limit);
    }

    public function index()
    {
        $students = DB::table('users')->paginate(10);
        return view ('admin.student.index')->with(compact('students'));
    }

    public function formStudent($user_id)
    {
        $infoUser = User::find($user_id);

        $t = $this->_table;
        $t1 = $this->_table_courses;
        $coursesOfUser = DB::table($t)
            ->where($t . '.user_id', $user_id)
            ->join($t1, function ($join) {
                $join->on($this->_table . '.course_id', '=', $this->_table_courses . '.id');
            })
            ->select($t . '.*', $t1 . '.name as course_name')
            ->paginate($this->_limit);

        return view('admin.student.form-student')->with(compact('infoUser', 'coursesOfUser'));
    }

    public function editStudent($id)
    {
        $user = User::find($id);
        $breadcrumbs = array('student-edit', $user);
        return view('admin.student.edit-student')->with(compact('user','breadcrumbs'));
    }

    public function storeStudent($id, Request $request)
    {
        $users = User::find($id);

        $users->username = $request->get('username');
        $users->address  = $request->get('address');
        $users->group_id = $request->get('group_id');
        $users->phone    = $request->get('phone');
        $users->birthday = $request->get('birthday');
        $users->fullname = $request->get('fullname');

        if ( !empty($request->get('password')) ) {
            $users->password = Hash::make($request->get('password'));
        }

        $users->save();
        return redirect(route('student-list'));
    }

    public function delStudent($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect(route('student-list'));
    }

    public function addStudent(StudentRequest $request)
    {
        $data   = array(
            'username'  => $request->get('username'),
            'fullname'  => $request->get('fullname'),
            'email'     => $request->get('email'),
            'password'  => bcrypt($request->get('password')),
            'phone'     => $request->get('phone'),
            'group_id'  => $request->get('group_id'),
            'address'   => $request->get('address'),
            'birthday'  => date( 'Y-m-d', strtotime($request->get('birthday'))),
        );

        User::create($data);
        return redirect(route('student-list'));
    }
}
