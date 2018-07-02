<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Images;
use App\Http\Models\CategoryCourse;
use App\Http\Requests\CategoryCourseRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;

class CategoryCourseController extends Controller
{
    protected $_table = 'category_courses';
    protected $_limit = 15;

    public function __construct()
    {
        $this->_limit = env('LIMIT_SHOW_LIST', $this->_limit);
    }

    public function index()
    {
        $categoryModel = new CategoryCourse();
        $categories = $categoryModel->getCourseTree();
        return view('admin.category-course.index')->with(compact('categories'));
    }

    public function formCategoryCourse()
    {
        $data = DB::table('category_courses')->select('id', 'name', 'level', 'parent_id')->where('level', '<', 2)->get();
        $category[0] = 'Chọn danh mục';
        foreach ($data as $cate) {
            $category[$cate->id] = $cate->name;
        }

        return view('admin.category-course.form-category')->with(compact('category'));
    }

    public function editCategoryCourse($id)
    {
        $category = CategoryCourse::find($id);
        $data = DB::table('category_courses')->where('level', 0)->whereNotIn('id', array($id))->get();
        $categories[0] = 'Select category';
        foreach ($data as $cate) {
            $categories[$cate->id] = $cate->name;
        }
        return view('admin.category-course.edit-category')->with(compact('category', 'categories'));
    }

    public function storeCategoryCourse($id, CategoryCourseRequest $request)
    {
        $dataCategory = CategoryCourse::find($id);
        $dataCategory->name = $request->get('name');
        $dataCategory->catecode = ($request->get('catecode') != '') ? $request->get('catecode') : str_slug($request->get('name'));
        $dataCategory->status = $request->get('status');
        $dataCategory->description = $request->get('description');
        $dataCategory->meta_title = $request->get('meta_title');
        $dataCategory->meta_keyword = $request->get('meta_keyword');
        $dataCategory->meta_description = $request->get('meta_description');
        $dataCategory->parent_id = $request->get('parent_id');
        $dataCategory->level = (intval($request->get('parent_id')) > 0) ? 2 : 0;
        $dataCategory->modified_time = date('Y-m-d H:i:s');

        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            Images::deleteImage($dataCategory->image);
            $dataCategory->image = Images::createImage($image);
        }

        $dataCategory->save();
        return redirect(route('category-course-list'));
    }

    public function delCategoryCourse($id)
    {
        $users = CategoryCourse::find($id);
        $users->delete();
        return redirect(route('category-course-list'));
    }

    public function addCategoryCourse(CategoryCourseRequest $request)
    {
        $data = array(
            'name' => $request->get('name'),
            'catecode' => ($request->get('catecode') != '') ? $request->get('catecode') : str_slug($request->get('name')),
            'status' => $request->get('status'),
            'description' => $request->get('description'),
            'meta_title' => $request->get('meta_title'),
            'meta_keyword' => $request->get('meta_keyword'),
            'meta_description' => $request->get('meta_description'),
            'parent_id' => intval($request->get('parent_id')),
            'level' => (intval($request->get('parent_id')) > 0) ? 2 : 0,
            'created_time' => date('Y-m-d H:i:s')
        );

        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $data['image'] = Images::createImage($image);
        }

        CategoryCourse::create($data);
        return redirect(route('category-course-list'));
    }
}
