<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Images;
use App\Http\Models\CategoryCourse;
use App\Http\Models\Courses;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\User;
use DB;
use Hash;

class CourseController extends Controller
{
    protected $_limit = 15;
    protected $_table = 'courses';
    protected $_table_category = 'category_courses';

    public function __construct()
    {
        $this->_limit = env('LIMIT_SHOW_LIST', $this->_limit);
    }

    public function index()
    {
        $t = $this->_table;
        $t1 = $this->_table_category;

        $courses = DB::table($t)
            ->join($this->_table_category, function ($join) {
                $join->on($this->_table . '.category_id', '=', $this->_table_category . '.id');
            })
            ->select($t . '.id', $t . '.name', $t . '.price', $t . '.status', $t . '.publish_time', $t1 . '.name as category_name')
            ->paginate($this->_limit);

        return view('admin.course.index')->with(compact('courses'));
    }

    public function formCourses()
    {
        $category[0] = 'Select category course';
        $cateParent = CategoryCourse::where('level', '=', 0)->where('status', 1)->get();
        $cateChild = CategoryCourse::where('level', '=', 2)->where('status', 1)->get();
        $category = array();
        foreach ($cateParent as $idP => $cateP) {
            $category[$cateP->id] = $cateP->name;
            foreach ($cateChild as $idC => $cateC) {
                if ($cateP->id == $cateC->parent_id) {
                    $category[$cateC->id] = '|----------- ' . $cateC->name;
                    unset($cateChild[$idC]);
                }
            }
        }

        return view('admin.course.form-course')->with(compact('category'));
    }

    public function editCourses($id)
    {
        $course = Courses::join($this->_table_category, function ($join) {
            $join->on($this->_table . '.category_id', '=', $this->_table_category . '.id');
        })->select($this->_table . '.*', $this->_table_category . '.name as category_name')->find($id);

        $categoryModel = new CategoryCourse();
        $cate = $categoryModel->getCourseTree(1);
        $category = array();
        if (!empty($cate)) {
            foreach ($cate as $k => $v) {
                $category[$v->id] = $v->name;
            }
        }

        return view('admin.course.edit-course')->with(compact('course', 'category'));
    }

    public function storeCourses($id, CourseRequest $request)
    {
        $course = Courses::find($id);

        $category_id = intval($request->get('category_id'));
        $cateParent = CategoryCourse::find($category_id);
        $category_fullparent = '';
        $category_list = $category_id;
        if ($cateParent->parent_id > 0) {
            $category_fullparent = $cateParent->parent_id;
            $category_list = $category_id . ',' . $cateParent->parent_id;
        }

        $course->name = $request->get('name');
        $course->category_id = $category_id;
        $course->category_fullparent = $category_fullparent;
        $course->catelist = $category_list;
        $course->share_url = ($request->get('share_url') != '') ? $request->get('share_url') : str_slug($request->get('name'));
        $course->description = $request->get('description');
        $course->content = $request->get('content');
        $course->teacher_id = intval($request->get('teacher_id'));
        $course->price = intval($request->get('price'));
        $course->price_old = intval($request->get('price_old'));
        $course->start_sale = ($request->get('start_sale') != '') ? date('Y-m-d H:i:s', strtotime($request->get('start_sale'))) : null;
        $course->end_sale = ($request->get('end_sale') != '') ? date('Y-m-d H:i:s', strtotime($request->get('end_sale'))) : null;
        $course->publish_time = ($request->get('publish_time') != '') ? date('Y-m-d H:i:s', strtotime($request->get('publish_time'))) : date('Y-m-d H:i:s');
        $course->status = intval($request->get('status'));
        $course->modified_time = date('Y-m-d H:i:s');
        $course->meta_keyword = $request->get('meta_keyword');
        $course->meta_title = $request->get('meta_title');
        $course->meta_description = $request->get('meta_description');

        if (!empty($request->file('images'))) {
            $image = $request->file('images');
            $course->images = Images::createImage($image, '/img/upload/courses/');
        }

        $course->save();
        return redirect(route('course-list'));
    }

    public function delCourses($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect(route('course-list'));
    }

    public function addCourses(CourseRequest $request)
    {
        $category_id = intval($request->get('category_id'));
        $cateParent = CategoryCourse::find($category_id);
        $category_fullparent = '';
        $category_list = $category_id;
        if ($cateParent->parent_id > 0) {
            $category_fullparent = $cateParent->parent_id;
            $category_list = $category_id . ',' . $cateParent->parent_id;
        }

        $data = array(
            'name' => $request->get('name'),
            'category_id' => $category_id,
            'category_fullparent' => $category_fullparent,
            'catelist' => $category_list,
            'share_url' => ($request->get('share_url') != '') ? $request->get('share_url') : str_slug($request->get('name')),
            'description' => $request->get('description'),
            'content' => $request->get('content'),
            'teacher_id' => intval($request->get('teacher_id')),
            'price' => intval($request->get('price')),
            'price_old' => intval($request->get('price_old')),
            'start_sale' => ($request->get('start_sale') != '') ? date('Y-m-d H:i:s', strtotime($request->get('start_sale'))) : null,
            'end_sale' => ($request->get('end_sale') != '') ? date('Y-m-d H:i:s', strtotime($request->get('end_sale'))) : null,
            'publish_time' => ($request->get('publish_time') != '') ? date('Y-m-d H:i:s', strtotime($request->get('publish_time'))) : date('Y-m-d H:i:s'),
            'status' => intval($request->get('status')),
            'create_time' => date('Y-m-d H:i:s'),
            'meta_keyword' => $request->get('meta_keyword'),
            'meta_title' => $request->get('meta_title'),
            'meta_description' => $request->get('meta_description'),
        );

        if (!empty($request->file('images'))) {
            $image = $request->file('images');
            $data['images'] = Images::createImage($image, '/img/upload/courses/');
        }

        Courses::create($data);
        return redirect(route('course-list'));
    }
}
