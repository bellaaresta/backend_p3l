<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        
        if(count($drivers) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $drivers
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $drivers = Driver::find($id);
        if(!is_null($drivers)) {
            return response([
                'message' => 'Retrieve Driver Success',
                'data' => $drivers
            ], 200);
        }

        return response([
            'message' => 'Driver Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_driver' => 'required',
            'alamat_driver' => 'required', 
            'tgl_lahir_driver' => 'required',
            'jenis_kelamin_driver' => 'required',
            'notelp_driver' => 'required', 
            'email_driver' => 'required',
            'password_driver' => 'required', 
            'status_tersedia' => 'required', 
            'berkas_driver' => 'required',
            'bahasa'=> 'required'
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $drivers = Driver::create($storeData);
        return response([
            'message' => 'Add Driver Success',
            'data' => $drivers
        ], 200);
    }

    public function destroy($id)
    {
        $drivers = Driver::find($id);

        if (is_null($drivers)) {
            return response([
                'message' => 'Driver Not Found',
                'data' => null
            ], 404);
        }

        if ($drivers->delete()) {
            return response([
                'message' => 'Delete Driver Success',
                'data' => $drivers
            ], 200);
        }

        return response([
            'message' => 'Delete Driver Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $drivers = Driver::find($id);
        if(is_null($drivers)) {
            return response([
                'message' => 'Driver Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_driver' => 'required',
            'alamat_driver' => 'required', 
            'tgl_lahir_driver' => 'required',
            'jenis_kelamin_driver' => 'required',
            'notelp_driver' => 'required', 
            'email_driver' => 'required',
            'password_driver' => 'required', 
            'status_tersedia' => 'required', 
            'berkas_driver' => 'required',
            'bahasa'=> 'required'
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $drivers->nama_driver = $updateData['nama_driver'];
        $drivers->alamat_driver = $updateData['alamat_driver'];
        $drivers->tgl_lahir_driver = $updateData['tgl_lahir_driver'];
        $drivers->jenis_kelamin_driver = $updateData['jenis_kelamin_driver'];
        $drivers->notelp_driver = $updateData['notelp_driver'];
        $drivers->email_driver = $updateData['email_driver'];
        $drivers->password_driver = $updateData['password_driver'];
        $drivers->status_tersedia = $updateData['status_tersedia'];
        $drivers->berkas_driver = $updateData['berkas_driver'];
        $drivers->bahasa = $updateData['bahasa'];

        if ($drivers->save()) {
            return response([
                'message' => 'Update Driver Success',
                'data' => $drivers
            ], 200);
        }

        return response([
            'message' => 'Update Driver Failed',
            'data' => null
        ], 400);
    }
}
