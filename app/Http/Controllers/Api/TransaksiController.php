<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        
        if(count($transaksis) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksis
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $transaksis = Transaksi::find($id);
        if(!is_null($transaksis)) {
            return response([
                'message' => 'Retrieve Transaksi Success',
                'data' => $transaksis
            ], 200);
        }

        return response([
            'message' => 'Transaksi Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'no_ktp' => 'required',
            'no_sim' => 'required',
            'tgl_transaksi' => 'required',
            'tgl_mulai_sewa' => 'required', 
            'tgl_selesai_sewa' => 'required', 
            'metode_pembayaran' => 'required', 
            'total_biaya_sewa' => 'required',
            'ekstensi_biaya' => 'required', 
            'status_transaksi' => 'required',
            'status_verifikasi' => 'required',
            //'rating_driver' => 'required',
            //'jenis_transaksi' => 'required',
            'id_customer' => 'required',
            //'id_driver' => 'required',
            'id_pegawai' => 'required',
            'id_aset' => 'required',
            //'id_promo' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $transaksis = Transaksi::create($storeData);
        return response([
            'message' => 'Add Transaksi Success',
            'data' => $transaksis
        ], 200);
    }

    public function destroy($id)
    {
        $transaksis = Transaksi::find($id);

        if(is_null($transaksis)) {
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        if($transaksis->delete()) {
            return response([
                'message' => 'Delete Transaksi Success',
                'data' => $transaksis
            ], 200);
        }

        return response([
            'message' => 'Delete Transaksi Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $transaksis = Transaksi::find($id);
        if(is_null($transaksis)) {
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'no_ktp' => 'required',
            'no_sim' => 'required',
            'tgl_transaksi' => 'required',
            'tgl_mulai_sewa' => 'required', 
            'tgl_selesai_sewa' => 'required', 
            'metode_pembayaran' => 'required', 
            'total_biaya_sewa' => 'required',
            'ekstensi_biaya' => 'required', 
            'status_transaksi' => 'required',
            'status_verifikasi' => 'required',
            //'rating_driver' => 'required',
            //'jenis_transaksi' => 'required',
            'id_customer' => 'required',
            //'id_driver' => 'required',
            'id_pegawai' => 'required',
            'id_aset' => 'required',
            //'id_promo' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $transaksis->no_ktp = $updateData['no_ktp'];
        $transaksis->no_sim = $updateData['no_sim'];
        $transaksis->tgl_transaksi = $updateData['tgl_transaksi'];
        $transaksis->tgl_mulai_sewa = $updateData['tgl_mulai_sewa'];
        $transaksis->tgl_selesai_sewa = $updateData['tgl_selesai_sewa'];
        $transaksis->metode_pembayaran = $updateData['metode_pembayaran'];
        $transaksis->total_biaya_sewa = $updateData['total_biaya_sewa'];
        $transaksis->ekstensi_biaya = $updateData['ekstensi_biaya'];
        $transaksis->status_transaksi = $updateData['status_transaksi'];
        $transaksis->status_verifikasi = $updateData['status_verifikasi'];
        //$transaksis->rating_driver = $updateData['rating_driver'];
        //$transaksis->jenis_transaksi = $updateData['jenis_transaksi'];
        $transaksis->id_customer = $updateData['id_customer'];
        $transaksis->id_driver = $updateData['id_driver'];
        $transaksis->id_pegawai = $updateData['id_pegawai'];
        $transaksis->id_aset = $updateData['id_aset'];
        $transaksis->id_promo = $updateData['id_promo'];
        
        if ($transaksis->save()) {
            return response([
                'message' => 'Update Transaksi Success',
                'data' => $transaksis
            ], 200);
        }
        return response([
            'message' => 'Update Transaksi Failed',
            'data' => null,
        ], 400);
    }
}
