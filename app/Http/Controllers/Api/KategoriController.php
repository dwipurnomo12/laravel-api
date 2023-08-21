<?php

namespace App\Http\Controllers\Api;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('id', 'DESC')->get();
        return response()->json([
            'status'    => true,
            'message'   => 'Data Found',
            'data'      => $kategori
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori'  => 'required',
        ], [
            'kategori'  => 'Kolom Kategori Wajib Diisi !'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $kategori = kategori::create([
            'kategori'  => $request->kategori
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Data Added Succesfully',
            'data'      => $kategori
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategori = Kategori::find($id);
        if($kategori){
            return response()->json([
                'status'    => true,
                'message'   => 'Data Found',
                'data'      => $kategori
            ], 200);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Data Not Found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        if(empty($kategori)){
            return response()->json([
                'status'    => false,
                'message'   => 'Data Not Found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'kategori'  => 'required',
        ], [
            'kategori'  => 'Kolom Kategori Wajib Diisi !'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $kategori->update([
            'kategori'  => $request->kategori
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Udate Data Sucessfully',
            'data'      => $kategori
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = kategori::find($id);
        if($kategori){
            if($kategori->delete()){
                return response()->json([
                    'status'    => true,
                    'message'   => 'Delete Data Sucessfully'
                ], 200);
            } else {
                return response()->json([
                    'status'    => false,
                    'mesage'    => 'Delete Data Failed'
                ], 500);
            }
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Data Not Found'
            ], 404);
        }
    }
}
