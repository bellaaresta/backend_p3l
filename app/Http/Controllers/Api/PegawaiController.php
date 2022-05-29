<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        
        if(count($pegawais) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pegawais
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $pegawais = Pegawai::find($id);
        if(!is_null($pegawais)) {
            return response([
                'message' => 'Retrieve Pegawai Success',
                'data' => $pegawais
            ], 200);
        }

        return response([
            'message' => 'Pegawai Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_pegawai' => 'required',
            'alamat_pegawai' => 'required',
            'tgl_lahir_pegawai' => 'required',
            'jenis_kelamin_pegawai' => 'required', 
            'email_pegawai' => 'required', 
            'password_pegawai' => 'required', 
            'foto_pegawai' => 'required', 
            'id_role' => 'required', 
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pegawais = Pegawai::create($storeData);
        return response([
            'message' => 'Add Pegawai Success',
            'data' => $pegawais
        ], 200);
    }

    public function destroy($id)
    {
        $pegawais = Pegawai::find($id);

        if(is_null($pegawais)) {
            return response([
                'message' => 'Pegawai Not Found',
                'data' => null
            ], 404);
        }

        if($pegawais->delete()) {
            return response([
                'message' => 'Delete Pegawai Success',
                'data' => $pegawais
            ], 200);
        }

        return response([
            'message' => 'Delete Pegawai Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $pegawais = Pegawai::find($id);
        if(is_null($pegawais)) {
            return response([
                'message' => 'Pegawai Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_pegawai' => 'required',
            'alamat_pegawai' => 'required',
            'tgl_lahir_pegawai' => 'required',
            'jenis_kelamin_pegawai' => 'required', 
            'email_pegawai' => 'required', 
            'password_pegawai' => 'required', 
            'foto_pegawai' => 'required', 
            'id_role' => 'required', 
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $pegawais->nama_pegawai = $updateData['nama_pegawai'];
        $pegawais->alamat_pegawai = $updateData['alamat_pegawai'];
        $pegawais->tgl_lahir_pegawai = $updateData['tgl_lahir_pegawai'];
        $pegawais->jenis_kelamin_pegawai = $updateData['jenis_kelamin_pegawai'];
        $pegawais->email_pegawai = $updateData['email_pegawai'];
        $pegawais->password_pegawai = $updateData['password_pegawai'];
        $pegawais->foto_pegawai = $updateData['foto_pegawai'];
        $pegawais->id_role = $updateData['id_role'];

        if ($pegawais->save()) {
            return response([
                'message' => 'Update Pegawai Success',
                'data' => $pegawais
            ], 200);
        }
        return response([
            'message' => 'Update Pegawai Failed',
            'data' => null,
        ], 400);
    }
}
