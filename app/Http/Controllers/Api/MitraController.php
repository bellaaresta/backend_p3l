<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Mitra;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::all();
        
        if(count($mitras) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $mitras
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $mitras = Mitra::find($id);
        if(!is_null($mitras)) {
            return response([
                'message' => 'Retrieve Aset Success',
                'data' => $mitras
            ], 200);
        }

        return response([
            'message' => 'Aset Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'no_ktp' => 'required',
            'nama_mitra' => 'required',
            'alamat_mitra' => 'required',
            'notelp_mitra' => 'required', 
            'periode_mulai_kontrak' => 'required', 
            'periode_selesai_kontrak' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $mitras = Mitra::create($storeData);
        return response([
            'message' => 'Add Mitra Success',
            'data' => $mitras
        ], 200);
    }

    public function destroy($id)
    {
        $mitras = Mitra::find($id);

        if(is_null($mitras)) {
            return response([
                'message' => 'Mitra Not Found',
                'data' => null
            ], 404);
        }

        if($mitras->delete()) {
            return response([
                'message' => 'Delete Mitra Success',
                'data' => $mitras
            ], 200);
        }

        return response([
            'message' => 'Delete Mitra Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $mitras = Mitra::find($id);
        if(is_null($mitras)) {
            return response([
                'message' => 'Mitra Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'no_ktp' => 'required',
            'nama_mitra' => 'required',
            'alamat_mitra' => 'required',
            'notelp_mitra' => 'required', 
            'periode_mulai_kontrak' => 'required', 
            'periode_selesai_kontrak' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $mitras->no_ktp = $updateData['no_ktp'];
        $mitras->nama_mitra = $updateData['nama_mitra'];
        $mitras->alamat_mitra = $updateData['alamat_mitra'];
        $mitras->notelp_mitra = $updateData['notelp_mitra'];
        $mitras->periode_mulai_kontrak = $updateData['periode_mulai_kontrak'];
        $mitras->periode_selesai_kontrak = $updateData['periode_selesai_kontrak'];

        if ($mitras->save()) {
            return response([
                'message' => 'Update Mitra Success',
                'data' => $mitras
            ], 200);
        }
        return response([
            'message' => 'Update Mitra Failed',
            'data' => null,
        ], 400);
    }
}
