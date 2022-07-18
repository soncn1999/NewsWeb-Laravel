<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index() {
        $users = $this->user->where('isAdmin',1)->paginate();
        return view('admin.user.index',compact('users'));
    }

    public function create() {
        $roles = $this->role->all();
        return view('admin.user.add',compact('roles'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isAdmin' => 1,
            ]);

            $roleIds = $request->role_id;
            $user->roles()->attach($roleIds);
            DB::commit();
        }catch(\Exception $exception){
            DB::rollback();
            Log::error('Message: '.$exception->getMessage(). ' Line: '. $exception->getLine());
        }
        return redirect()->route('users.index');
    }

    public function edit($id) {
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $rolesOfUser = $user->roles;
        return view('admin.user.edit',compact('roles','user','rolesOfUser'));
    }

    public function update(Request $request,$id){
        try {
            DB::beginTransaction();
            $user = $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user = $this->user->find($id);
            $roleIds = $request->role_id;
            $user->roles()->sync($roleIds);
            DB::commit();
        }catch(\Exception $exception){
            DB::rollback();
            Log::error('Message: '.$exception->getMessage(). ' Line: '. $exception->getLine());
        }
        return redirect()->route('users.index');
    }

    public function delete($id){
        try {
            $this->user->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' line' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
