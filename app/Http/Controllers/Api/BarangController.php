<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::orderBy('id', 'DESC')->get();
        return  response()->json([
            'status'    => true,
            'message'   => 'Data Found',
            'data'      => $barang
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nm_barang'     => 'required',
            'hrg_beli'      => 'required|numeric',
            'hrg_jual'      => 'required|numeric',
            'deskripsi'     => 'required',
            'kategori_id'   => 'required'
        ], [
            'nm_barang.required'    => 'Kolom Nama Barang Wajib Diisi !',
            'hrg_beli.required'     => 'Kolom Harga Beli Wajib Diisi !',
            'hrg_beli.numeric'      => 'Gunakan Inputan Hanya Angka',
            'hrg_jual.required'     => 'Kolom Harga Jual Wajib Diisi !',
            'hrg_juaml.numeric'     => 'Gunakan Inputan Hanya Angka',
            'deskripsi.required'    => 'Kolom Deskripsi Wajib Diisi !', 
            'kategori_id.required'  => 'Wajib Memilih Kategori'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $barang = Barang::create([
            'nm_barang'     => $request->nm_barang,
            'hrg_beli'      => $request->hrg_beli,
            'hrg_jual'      => $request->hrg_jual,
            'deskripsi'     => $request->deskripsi,
            'kategori_id'   => $request->kategori_id
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Data Added Successfully',
            'data'      => $barang
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        if($barang){
            return response()->json([
                'status'    => true,
                'message'   => 'Data Found',
                'data'      => $barang
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
        $barang = Barang::find($id);
        if(empty($barang)){
            return response()->json([
                'status'    => false,
                'message'   => 'Data Not Found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nm_barang'     => 'required',
            'hrg_beli'      => 'required|numeric',
            'hrg_jual'      => 'required|numeric',
            'deskripsi'     => 'required',
            'kategori_id'   => 'required'
        ], [
            'nm_barang.required'    => 'Kolom Nama Barang Wajib Diisi !',
            'hrg_beli.required'     => 'Kolom Harga Beli Wajib Diisi !',
            'hrg_beli.numeric'      => 'Gunakan Inputan Hanya Angka',
            'hrg_jual.required'     => 'Kolom Harga Jual Wajib Diisi !',
            'hrg_juaml.numeric'     => 'Gunakan Inputan Hanya Angka',
            'deskripsi.required'    => 'Kolom Deskripsi Wajib Diisi !',
            'kategori_id.required'  => 'Wajib Memilih kategori'  
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $barang->update([
            'nm_barang'     => $request->nm_barang,
            'hrg_beli'      => $request->hrg_beli,
            'hrg_jual'      => $request->hrg_jual,
            'deskripsi'     => $request->deskripsi,
            'kategori_id'   => $request->kategori_id
        ]);
        
        return response()->json([
            'status'    => true,
            'messge'    => 'Updata Data Successfully',
            'data'      => $barang
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        if($barang){
            if($barang->delete()){
                return response()->json([
                    'status'    => true,
                    'mesage'    => 'Delete Data Successfully'
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
