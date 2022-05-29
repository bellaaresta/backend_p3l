<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        
        if(count($customers) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $customers
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $customers = Customer::find($id);
        if(!is_null($customers)) {
            return response([
                'message' => 'Retrieve Customer Success',
                'data' => $customers
            ], 200);
        }

        return response([
            'message' => 'Customer Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required', 
            'password' => 'required', 
            'no_telp' => 'required', 
            'alamat' => 'required', 
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $customers = Customer::create($storeData);
        return response([
            'message' => 'Add Customer Success',
            'data' => $customers
        ], 200);
    }

    public function destroy($id)
    {
        $customers = Customer::find($id);

        if(is_null($customers)) {
            return response([
                'message' => 'Customer Not Found',
                'data' => null
            ], 404);
        }

        if($customers->delete()) {
            return response([
                'message' => 'Delete Customer Success',
                'data' => $customers
            ], 200);
        }

        return response([
            'message' => 'Delete Customer Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $customers = Customer::find($id);
        if(is_null($customers)) {
            return response([
                'message' => 'Customer Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required', 
            'password' => 'required', 
            'no_telp' => 'required', 
            'alamat' => 'required', 
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $customers->nama_lengkap = $updateData['nama_lengkap'];
        $customers->tanggal_lahir = $updateData['tanggal_lahir'];
        $customers->jenis_kelamin = $updateData['jenis_kelamin'];
        $customers->email = $updateData['email'];
        $customers->password = $updateData['password'];
        $customers->no_telp = $updateData['no_telp'];
        $customers->alamat = $updateData['alamat'];

        if ($customers->save()) {
            return response([
                'message' => 'Update Customer Success',
                'data' => $customers
            ], 200);
        }
        return response([
            'message' => 'Update Customer Failed',
            'data' => null,
        ], 400);
    }
}
