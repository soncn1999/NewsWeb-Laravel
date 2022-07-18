<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission) {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index() {
        $roles = $this->role->paginate();
        return view('admin.role.index',compact('roles'));
    }

    public function create() {
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        return view('admin.role.add', compact('permissionsParent'));
    }

    public function store(Request $request) {
        $role = $this->role->create([
           'name' => $request->name,
            'code'=> $request->code,
        ]);

        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }

    public function edit(Request $request, $id) {
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        $role = $this->role->find($id);
        $permissionsChecked = $role->permissions;
        return view('admin.role.edit', compact('permissionsParent','role','permissionsChecked'));
    }

    public function update(Request $request,$id) {
        $role = $this->role->find($id);
        $role->update([
            'name' => $request->name,
            'code'=> $request->code,
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('roles.index');
    }


}
