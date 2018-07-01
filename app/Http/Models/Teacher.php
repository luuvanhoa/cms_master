<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $table = 'teachers';

    protected $fillable = [
        'name',
        'address',
        'status',
        'avatar',
        'description', // mô tả ngắn
        'content', // bài viết về giảng viên
        'cmnd', // cmnd
        'created_time',
        'created_by',
        'modified_time',
        'modified_by'
    ];

}
