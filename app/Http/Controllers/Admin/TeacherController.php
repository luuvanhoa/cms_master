<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Images;
use App\Http\Models\Groups;
use App\Http\Models\Teacher;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use DB;

class TeacherController extends Controller
{
    protected $_limit = 15;
    protected $_table = 'teachers';
    protected $_folder_upload = '/img/upload/teacher/';

    public function __construct()
    {
        $this->_limit = env('LIMIT_SHOW_LIST', $this->_limit);
    }

    public function index()
    {
        $teachers = DB::table($this->_table)->paginate($this->_limit);
        return view('admin.teacher.index')->with(compact('teachers'));
    }

    public function formTeacher()
    {
        return view('admin.teacher.form-teacher');
    }

    public function editTeacher($id)
    {
        $teacher = Teacher::find($id);
        return view('admin.teacher.edit-teacher')->with(compact('teacher'));
    }

    public function storeTeacher(TeacherRequest $request, $id)
    {
        $data = Teacher::find($id);
        $data->fullname = $request->get('fullname', null);
        $data->phone = $request->get('phone');
        $data->status = $request->get('status');
        $data->cmnd = $request->get('cmnd');
        $data->modified_by = $request->get('modified_by', '');
        $data->modified_time = date('Y-m-d H:i:s');
        $data->info = $request->get('info');
        $data->description = $request->get('description');
        $data->content = $request->get('content');

        if (!empty($request->file('avatar'))) {
            $image = $request->file('avatar');
            Images::deleteImage($data->avatar);
            $data->avatar = Images::createImage($image, $this->_folder_upload);
        }

        $data->save();
        return redirect(route('teacher-list'));
    }

    public function delTeacher($id)
    {
        $users = Teacher::find($id);
        $users->delete();
        return redirect(route('teacher-list'));
    }

    public function addTeacher(TeacherRequest $request)
    {
        $data = array(
            'username' => $request->get('username'),
            'fullname' => $request->get('fullname'),
            'phone' => $request->get('phone'),
            'status' => $request->get('status', 2),
            'address' => $request->get('address', ''),
            'description' => $request->get('description', ''),
            'content' => $request->get('content', ''),
            'cmnd' => $request->get('cmnd', ''),
            'info' => $request->get('info', ''),
            'created_by' => $request->get('created_by', null),
            'created_time' => date('Y-m-d H:i:s'),
        );

        if (!empty($request->file('avatar'))) {
            $image = $request->file('avatar');
            $data['avatar'] = Images::createImage($image, $this->_folder_upload);
        }

        Teacher::create($data);
        return redirect(route('teacher-list'));
    }
}
