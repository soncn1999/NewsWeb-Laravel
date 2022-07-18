<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    public function createPermissions() {
        return view('admin.permission.add');
    }

    public function store(Request $request) {
        $permission = Permission::create([
            'name' => $request->module_parent,
            'code' => $request->module_parent,
            'parent_id' => 0
        ]);

        foreach ($request->module_childrent as $value) {
            Permission::create([
                'name' => $value,
                'code' => $value,
                'parent_id' => $permission->id,
                'key_code' => $request->module_parent.'_'.$value,
            ]);
        }

        return redirect()->route('permissions.create');
    }
}
