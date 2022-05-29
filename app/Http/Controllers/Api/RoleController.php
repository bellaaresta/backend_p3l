<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        
        if(count($roles) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $roles
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $roles = Role::find($id);
        if(!is_null($roles)) {
            return response([
                'message' => 'Retrieve Role Success',
                'data' => $roles
            ], 200);
        }

        return response([
            'message' => 'Role Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_role' => 'required', 
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $roles = Role::create($storeData);
        return response([
            'message' => 'Add Role Success',
            'data' => $roles
        ], 200);
    }

    public function destroy($id)
    {
        $roles = Role::find($id);

        if(is_null($roles)) {
            return response([
                'message' => 'Role Not Found',
                'data' => null
            ], 404);
        }

        if($roles->delete()) {
            return response([
                'message' => 'Delete Role Success',
                'data' => $roles
            ], 200);
        }

        return response([
            'message' => 'Delete Role Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $roles = Role::find($id);
        if(is_null($roles)) {
            return response([
                'message' => 'Role Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_role' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $roles->nama_role = $updateData['nama_role'];

        if ($roles->save()) {
            return response([
                'message' => 'Update Roles Success',
                'data' => $roles
            ], 200);
        }
        return response([
            'message' => 'Update Role Failed',
            'data' => null,
        ], 400);
    }
}
