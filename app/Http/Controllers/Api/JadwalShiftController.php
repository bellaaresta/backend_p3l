<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\JadwalShift;

class JadwalShiftController extends Controller
{
    public function index()
    {
        $jadwalshifts = JadwalShift::all();
        
        if(count($jadwalshifts) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $jadwalshifts
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $jadwalshifts = JadwalShift::find($id);
        if(!is_null($jadwalshifts)) {
            return response([
                'message' => 'Retrieve Jadwal Shift Success',
                'data' => $jadwalshifts
            ], 200);
        }

        return response([
            'message' => 'Jadwal Shift Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'waktu_shift' => 'required', 
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $jadwalshifts = JadwalShift::create($storeData);
        return response([
            'message' => 'Add Jadwal Shift Success',
            'data' => $jadwalshifts
        ], 200);
    }

    public function destroy($id)
    {
        $jadwalshifts = JadwalShift::find($id);

        if(is_null($jadwalshifts)) {
            return response([
                'message' => 'Jadwal Shift Not Found',
                'data' => null
            ], 404);
        }

        if($jadwalshifts->delete()) {
            return response([
                'message' => 'Delete Jadwal Shift Success',
                'data' => $jadwalshifts
            ], 200);
        }

        return response([
            'message' => 'Delete Jadwal Shift Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $jadwalshifts = Role::find($id);
        if(is_null($jadwalshifts)) {
            return response([
                'message' => 'Jadwal Shift Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'waktu_shift' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $jadwalshifts->waktu_shift = $updateData['waktu_shift'];

        if ($jadwalshifts->save()) {
            return response([
                'message' => 'Update Jadwal Shift Success',
                'data' => $jadwalshifts
            ], 200);
        }
        return response([
            'message' => 'Update Jadwal Shift Failed',
            'data' => null,
        ], 400);
    }
}
