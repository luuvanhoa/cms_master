<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $_auth = null;

    public function getInfoLogin()
    {
        $ObjUser = Auth::user();
        $dataUser = array(
            "id" => $ObjUser->id,
            "username" => $ObjUser->username,
            "fullname" => $ObjUser->fullname,
            "email" => $ObjUser->email,
            "status" => $ObjUser->status,
            "group_id" => $ObjUser->group_id,
            "admin" => $ObjUser->admin,
            "password" => $ObjUser->password,
            "address" => $ObjUser->address,
            "phone" => $ObjUser->phone,
            "birthday" => $ObjUser->birthday,
            "register_date" => $ObjUser->register_date,
            "last_login" => $ObjUser->last_login,
            "token_login" => $ObjUser->token_login,
            "created_at" => $ObjUser->created_at,
            "updated_at" => $ObjUser->updated_at,
            "deleted_at" => $ObjUser->deleted_at,
        );
        return $this->_auth = $dataUser;
    }
}
