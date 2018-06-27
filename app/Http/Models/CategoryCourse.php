<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryCourse extends Model
{
    public $table = 'category_courses';

    protected $fillable = [
        'name',
        'catecode',
        'parent_id',
        'ordering',
        'show_frontend',
        'image',
        'level',
        'status',
        'description',
        'options',
        'meta_description',
        'meta_title',
        'meta_keyword',
        'created_time',
        'modified_time',
        'fullcate_parent'
    ];

    public function getCourseTree($status = null)
    {
        //get list cate parent
        $cateParentModel = DB::table($this->table)->where('level', '=', 0);
        if ($status != null) {
            $cateParentModel->where('status', intval($status));
        }
        $cateParent = $cateParentModel->get();

        //get list cate child
        $cateChildModel = DB::table($this->table)->where('level', '=', 2);
        if ($status != null) {
            $cateChildModel->where('status', intval($status));
        }
        $cateChild = $cateChildModel->get();

        $categories = array();
        foreach ($cateParent as $idP => $cateP) {
            $categories[] = $cateP;
            foreach ($cateChild as $idC => $cateC) {
                if ($cateP->id == $cateC->parent_id) {
                    $cateC->name = '|----------- ' . $cateC->name;
                    $categories[] = $cateC;
                    unset($cateChild[$idC]);
                }
            }
        }
        return $categories;
    }
}
