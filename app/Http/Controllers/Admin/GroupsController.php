<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Groups;
use App\Http\Requests\GroupsRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use DB;

class GroupsController extends Controller
{
    protected $_limit = 15;
    protected $_table = 'group';

    public function __construct()
    {
        $this->_limit = env('LIMIT_SHOW_LIST', $this->_limit);
    }

    public function index()
    {
        $groups = DB::table($this->_table)->paginate($this->_limit);
        return view('admin.groups.index')->with(compact('groups'));
    }

    public function formGroup()
    {
        return view('admin.groups.form-group');
    }

    public function editGroup($id)
    {
        $group = Groups::find($id);
        return view('admin.groups.edit-group')->with(compact('group'));
    }

    public function storeGroup(GroupsRequest $request, $id)
    {
        $data = Groups::find($id);

        $data->name = $request->get('name');
        $data->group_acp = $request->get('group_acp', 1);
        $data->privilege_id = $request->get('privilege_id', 1);
        $data->ordering = $request->get('ordering', 10);
        $data->modified_by = $request->get('modified_by', null);
        $data->modified_time = date('Y-m-d H:i:s');
        $data->save();
        return redirect(route('group-list'));
    }

    public function delGroup($id)
    {
        $users = Groups::find($id);
        $users->delete();
        return redirect(route('group-list'));
    }

    public function addGroup(GroupsRequest $request)
    {
        $data = array(
            'name' => $request->get('name'),
            'group_acp' => $request->get('group_acp', 1),
            'privilege_id' => $request->get('privilege_id', 1),
            'ordering' => $request->get('ordering', 10),
            'created_by' => $request->get('created_by', null),
            'created_time' => date('Y-m-d H:i:s'),
        );

        Groups::create($data);
        return redirect(route('group-list'));
    }
}
