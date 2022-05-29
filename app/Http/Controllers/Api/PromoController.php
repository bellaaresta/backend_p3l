<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::all();
        
        if(count($promos) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $promos
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $promos = Promo::find($id);
        if(!is_null($promos)) {
            return response([
                'message' => 'Retrieve Promo Success',
                'data' => $promos
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
            'kode_promo' => 'required',
            'jenis_promo' => 'required',
            'diskon_promo' => 'required',
            'keterangan' => 'required', 
            'status_promo' => 'required', 
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $promos = Promo::create($storeData);
        return response([
            'message' => 'Add Promo Success',
            'data' => $promos
        ], 200);
    }

    public function destroy($id)
    {
        $promos = Promo::find($id);

        if(is_null($promos)) {
            return response([
                'message' => 'Promo Not Found',
                'data' => null
            ], 404);
        }

        if($promos->delete()) {
            return response([
                'message' => 'Delete Promo Success',
                'data' => $promos
            ], 200);
        }

        return response([
            'message' => 'Delete Promo Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $promos = Promo::find($id);
        if(is_null($promos)) {
            return response([
                'message' => 'Promo Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'kode_promo' => 'required',
            'jenis_promo' => 'required',
            'diskon_promo' => 'required',
            'keterangan' => 'required', 
            'status_promo' => 'required', 
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $promos->kode_promo = $updateData['kode_promo'];
        $promos->jenis_promo = $updateData['jenis_promo'];
        $promos->diskon_promo = $updateData['diskon_promo'];
        $promos->keterangan = $updateData['keterangan'];
        $promos->status_promo = $updateData['status_promo'];

        if ($promos->save()) {
            return response([
                'message' => 'Update Promo Success',
                'data' => $promos
            ], 200);
        }
        return response([
            'message' => 'Update Promo Failed',
            'data' => null,
        ], 400);
    }
}
