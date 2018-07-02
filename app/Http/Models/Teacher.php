<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $table = 'teachers';

    protected $fillable = [
        'username',
        'fullname',
        'address',
        'status',
        'avatar',
        'phone',
        'description', // mô tả ngắn
        'content', // bài viết về giảng viên
        'info', // các thông tin cần thiết
        'cmnd', // cmnd
        'created_time',
        'created_by',
        'modified_time',
        'modified_by'
    ];
}