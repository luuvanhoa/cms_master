<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'group_acp',
        'privilege_id',
        'ordering',
        'created_by',
        'modified_by',
        'created_time',
        'modified_time'
    ];

    public $table = 'group';
}
