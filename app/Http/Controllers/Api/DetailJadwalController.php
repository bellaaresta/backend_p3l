<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\DetailJadwal;

class DetailJadwalController extends Controller
{
    public function index()
    {
        $detailjadwals = DetailJadwal::all();
        
        if(count($detailjadwals) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $detailjadwals
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $detailjadwals = DetailJadwal::find($id);
        if(!is_null($detailjadwals)) {
            return response([
                'message' => 'Retrieve Detail Jadwal Success',
                'data' => $detailjadwals
            ], 200);
        }

        return response([
            'message' => 'Promo Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'hari_shift' => 'required',
            'id_shift' => 'required',
            'id_pegawai' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $detailjadwals = DetailJadwal::create($storeData);
        return response([
            'message' => 'Add Detail Jadwal Success',
            'data' => $detailjadwals
        ], 200);
    }

    public function destroy($id)
    {
        $detailjadwals = Promo::find($id);

        if(is_null($detailjadwals)) {
            return response([
                'message' => 'Detail Jadwal Not Found',
                'data' => null
            ], 404);
        }

        if($detailjadwals->delete()) {
            return response([
                'message' => 'Delete Detail Jadwal Success',
                'data' => $detailjadwals
            ], 200);
        }

        return response([
            'message' => 'Delete Detail Jadwal Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $detailjadwals = DetailJadwal::find($id);
        if(is_null($detailjadwals)) {
            return response([
                'message' => 'Detail Jadwal Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'hari_shift' => 'required',
            'id_shift' => 'required',
            'id_pegawai' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $detailjadwals->hari_shift = $updateData['hari_shift'];
        $detailjadwals->id_shift = $updateData['id_shift'];
        $detailjadwals->id_pegawai = $updateData['id_pegawai'];

        if ($detailjadwals->save()) {
            return response([
                'message' => 'Update Detail Jadwal Success',
                'data' => $detailjadwals
            ], 200);
        }
        return response([
            'message' => 'Update Detail Jadwal Failed',
            'data' => null,
        ], 400);
    }
}
