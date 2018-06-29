<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Student;
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
    protected $_user_id = null;

    public function __construct()
    {
        $this->_limit = env('LIMIT_SHOW_LIST', $this->_limit);
    }

    public function index()
    {
        $students = DB::select('CALL get_students (0, 21) ');
        return view('admin.student.index')->with(compact('students'));
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

        // lấy data đổ vào select box
        $this->_user_id = $user_id;
        $dataCourseObj = DB::table($this->_table_courses)->whereNotIn('id',
            function ($q) {
                $q->select('course_id')->from($this->_table)->where('user_id', $this->_user_id)->where('status', 1)->get();
            })
            ->select('name', 'id')
            ->get();

        $listCourseSlbox[0] = 'Select courses';
        if (count($dataCourseObj) > 0) {
            foreach ($dataCourseObj as $course) {
                $listCourseSlbox[$course->id] = $course->name;
            }
        }

        return view('admin.student.form-student')->with(compact('infoUser', 'coursesOfUser', 'listCourseSlbox'));
    }

    public function viewInfo(Request $request)
    {
        $user_id = intval($request->get('user_id'));
        $infoUser = User::find($user_id);

        $t = $this->_table;
        $t1 = $this->_table_courses;
        $coursesOfUser = DB::table($t)
            ->where($t . '.user_id', $user_id)
            ->join($t1, function ($join) {
                $join->on($this->_table . '.course_id', '=', $this->_table_courses . '.id');
            })
            ->select($t . '.*', $t1 . '.name as course_name')
            ->get();

        echo json_encode(array(
            'infoUser' => $infoUser, 'coursesOfUser' => $coursesOfUser
        ));
    }

    public function editStudent($id)
    {
        $user = User::find($id);
        return view('admin.student.edit-student')->with(compact('user'));
    }

    public function storeStudent($id, Request $request)
    {
        $users = User::find($id);

        $users->username = $request->get('username');
        $users->address = $request->get('address');
        $users->group_id = $request->get('group_id');
        $users->phone = $request->get('phone');
        $users->birthday = $request->get('birthday');
        $users->fullname = $request->get('fullname');

        if (!empty($request->get('password'))) {
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
        $data = array(
            'user_id' => intval($request->get('user_id')),
            'course_id' => intval($request->get('course_id')),
            'status' => intval($request->get('status')),
            'payment' => intval($request->get('payment')),
            'payment_time' => $request->get('payment_time'),
            'note' => $request->get('note'),
            'create_time' => date('Y-m-d H:i:s'),
        );

        Student::create($data);
        return redirect(route('student-list'));
    }
}
