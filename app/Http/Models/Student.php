<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    public $table = 'users_courses';

    protected $fillable = [
        'course_id',
        'user_id',
        'status',
        'payment',
        'payment_time',
        'payment_type',
        'note',
        'created_time',
        'created_by',
        'modified_time',
        'modified_by'
    ];

}
