<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Aset;

class AsetController extends Controller
{
    public function index()
    {
        $asets = Aset::all();
        
        if(count($asets) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $asets
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $asets = Aset::find($id);
        if(!is_null($asets)) {
            return response([
                'message' => 'Retrieve Aset Success',
                'data' => $asets
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
            'nama_mobil' => 'required',
            'tipe_mobil' => 'required',
            'jenis_transmisi' => 'required',
            'volume_bahan_bakar' => 'required', 
            'warna_mobil' => 'required', 
            'kapasitas_mobil' => 'required',
            'fasilitas_mobil' => 'required', 
            'plat_nomor' => 'required', 
            'no_stnk' => 'required', 
            'kategori_aset' => 'required',
            'tgl_service_akhir' => 'required', 
            'status_ketersediaan' => 'required', 
            'biaya_sewa' => 'required',
            //'id_mitra' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $asets = Aset::create($storeData);
        return response([
            'message' => 'Add Aset Success',
            'data' => $asets
        ], 200);
    }

    public function destroy($id)
    {
        $asets = Aset::find($id);

        if(is_null($asets)) {
            return response([
                'message' => 'Aset Not Found',
                'data' => null
            ], 404);
        }

        if($asets->delete()) {
            return response([
                'message' => 'Delete Aset Success',
                'data' => $asets
            ], 200);
        }

        return response([
            'message' => 'Delete Aset Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $asets = Aset::find($id);
        if(is_null($asets)) {
            return response([
                'message' => 'Aset Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_mobil' => 'required',
            'tipe_mobil' => 'required',
            'jenis_transmisi' => 'required',
            'volume_bahan_bakar' => 'required', 
            'warna_mobil' => 'required', 
            'kapasitas_mobil' => 'required',
            'fasilitas_mobil' => 'required', 
            'plat_nomor' => 'required', 
            'no_stnk' => 'required', 
            'kategori_aset' => 'required',
            'tgl_service_akhir' => 'required', 
            'status_ketersediaan' => 'required', 
            'biaya_sewa' => 'required',
            //'id_mitra' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $asets->nama_mobil = $updateData['nama_mobil'];
        $asets->tipe_mobil = $updateData['tipe_mobil'];
        $asets->jenis_transmisi = $updateData['jenis_transmisi'];
        $asets->volume_bahan_bakar = $updateData['volume_bahan_bakar'];
        $asets->warna_mobil = $updateData['warna_mobil'];
        $asets->kapasitas_mobil = $updateData['kapasitas_mobil'];
        $asets->fasilitas_mobil = $updateData['fasilitas_mobil'];
        $asets->plat_nomor = $updateData['plat_nomor'];
        $asets->no_stnk = $updateData['no_stnk'];
        $asets->kategori_aset = $updateData['kategori_aset'];
        $asets->tgl_service_akhir = $updateData['tgl_service_akhir'];
        $asets->status_ketersediaan = $updateData['status_ketersediaan'];
        $asets->biaya_sewa = $updateData['biaya_sewa'];
        $asets->id_mitra = $updateData['id_mitra'];

        if ($asets->save()) {
            return response([
                'message' => 'Update Aset Success',
                'data' => $asets
            ], 200);
        }
        return response([
            'message' => 'Update Aset Failed',
            'data' => null,
        ], 400);
    }
}

