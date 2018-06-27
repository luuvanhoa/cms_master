<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminRquest;
use Auth;
use Session;
use App\User;
use DB;
use Hash;

class UserController extends Controller
{
    protected $_limit = 15;

    public function __construct()
    {
        $this->_limit = env('LIMIT_SHOW_LIST', $this->_limit);
    }

    public function index(Request $request)
    {
        $params_default = array('title' => '', 'email' => '', 'group_id' => 0, 'status' => 0);
        $params = array_merge($params_default, $request->all());

        $model = DB::table('users');
        $model->where('id', '>', 0);

        if ($params['title'] && $params['title'] != '') {
            if (intval($params['title']) > 0) {
                $model->where('id', intval($params['title']));
            } else {
                $model->where('fullname', 'like', '%' . $params['title'] . '%');
            }
        }

        if ($params['email'] && $params['email'] != '') {
            $model->where('email', 'like', $params['email'] . '%');
        }

        if ($params['group_id'] && intval($params['group_id']) > 0) {
            $model->where('group_id', intval($params['group_id']));
        }

        if ($params['status'] && intval($params['status']) > 0) {
            $model->where('status', intval($params['status']));
        }

        $users = $model->paginate($this->_limit);

        return view('admin.user.index')->with(compact('users', 'params'));
    }

    public function formUser()
    {
        $breadcrumbs = array('user-add', null);
        return view('admin.user.form-user')->with(compact('breadcrumbs'));
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $breadcrumbs = array('user-edit', $user);
        return view('admin.user.edit-user')->with(compact('user', 'breadcrumbs'));
    }

    public function storeUser($id, Request $request)
    {
        $users = User::find($id);

        $users->address = $request->get('address');
        $users->group_id = $request->get('group_id');
        $users->phone = $request->get('phone');
        $users->status = $request->get('status');
        $users->birthday = $request->get('birthday');
        $users->fullname = $request->get('fullname');

        if (!empty($request->get('password'))) {
            $users->password = Hash::make($request->get('password'));
        }

        $users->save();
        return redirect(route('user-list'));
    }

    public function delUser($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect(route('user-list'));
    }

    public function addUser(LoginAdminRquest $request)
    {
        $data = array(
            'username' => $request->get('username'),
            'fullname' => $request->get('fullname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'phone' => $request->get('phone'),
            'group_id' => $request->get('group_id'),
            'address' => $request->get('address'),
            'birthday' => date('Y-m-d', strtotime($request->get('birthday'))),
        );

        User::create($data);
        return redirect(route('user-list'));
    }

    public function login()
    {
        return view('admin.user.login');
    }

    public function loginPost(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password, 'admin' => 1])) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/admin/login');
        }
    }

    public function logOut()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
