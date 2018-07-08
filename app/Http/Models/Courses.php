<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Courses extends Model
{
    public $table = 'courses';

    protected $fillable = [
        'name',
        'share_url',
        'category_id',
        'category_fullparent',
        'catelist',
        'description',
        'content',
        'teacher_id',
        'price',
        'price_old',
        'start_sale',
        'images',
        'end_sale',
        'publish_time',
        'status',
        'modified_time',
        'modified_by',
        'create_time',
        'create_by',
        'meta_description',
        'meta_title',
        'meta_keyword',
        'created_time',
        'modified_time',
        'courseid_old'
    ];
}
