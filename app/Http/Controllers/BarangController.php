<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
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
        $client         = new Client();
        $url            = "http://127.0.0.1:8000/api/barang";
        $response       = $client->request('GET', $url);
        $content        = $response->getBody()->getContents();
        $contentArray   = json_decode($content, true);
        $data           = $contentArray['data'];

        return view('barang.index', [
            'data'  => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
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
            'deskripsi'     => 'required'
        ], [
            'nm_barang.required'    => 'Kolom Nama Barang Wajib Diisi !',
            'hrg_beli.required'     => 'Kolom Harga Beli Wajib Diisi !',
            'hrg_beli.numeric'      => 'Gunakan Inputan Hanya Angka',
            'hrg_jual.required'     => 'Kolom Harga Jual Wajib Diisi !',
            'hrg_jual.numeric'      => 'Gunakan Inputan Hanya Angka',
            'deskripsi.required'    => 'Kolom Deskripsi Wajib Diisi !'  
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.create')->withErrors($validator)->withInput();
        }

        $parameter = [
            'nm_barang' => $request->nm_barang,
            'hrg_beli'  => $request->hrg_beli,
            'hrg_jual'  => $request->hrg_jual,
            'deskripsi' => $request->deskripsi
        ];

        try{
            $client         = new Client();
            $url            = "http://127.0.0.1:8000/api/barang";
            $response       = $client->request('POST', $url, [
                'headers'   => ['Content-type' => 'application/json'],
                'body'      => json_encode($parameter)
            ]);
            $content        = $response->getBody()->getContents();
            $contentArray   = json_decode($content, true);
            
            if($contentArray['status'] != true){
                $error = $contentArray['data'];
                return redirect()->to('barang.create')->withErrors($error);
            } else {
                return redirect()->to('barang')->with('success', 'Sukses Menambahkan Data');
            }
        } catch (\Exception $e){
            return redirect()->route('barang.create')->withErrors('Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $client         = new Client();
            $url            = "http://127.0.0.1:8000/api/barang/{$id}";
            $response       = $client->request('GET', $url);
            $content        = $response->getBody()->getContents();
            $contentArray   = json_decode($content, true);

            if($contentArray['status'] != true){
                $error = $contentArray['data'];
                return redirect()->route('barang.index')->withErrors($error);
            }
            $data           = $contentArray['data'];
            return view('barang.edit', compact('data'));
        } catch(\Exception $e){
            return redirect()->route('barang.index')->withErrors('Terjadi kesalahan saat mengambil data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nm_barang'     => 'required',
            'hrg_beli'      => 'required|numeric',
            'hrg_jual'      => 'required|numeric',
            'deskripsi'     => 'required'
        ], [
            'nm_barang.required'    => 'Kolom Nama Barang Wajib Diisi !',
            'hrg_beli.required'     => 'Kolom Harga Beli Wajib Diisi !',
            'hrg_beli.numeric'      => 'Gunakan Inputan Hanya Angka',
            'hrg_jual.required'     => 'Kolom Harga Jual Wajib Diisi !',
            'hrg_jual.numeric'      => 'Gunakan Inputan Hanya Angka',
            'deskripsi.required'    => 'Kolom Deskripsi Wajib Diisi !'  
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.edit', $id)->withErrors($validator)->withInput();
        }

        $parameter = [
            'nm_barang' => $request->nm_barang,
            'hrg_beli'  => $request->hrg_beli,
            'hrg_jual'  => $request->hrg_jual,
            'deskripsi' => $request->deskripsi
        ];

        try{
            $client         = new Client();
            $url            = "http://127.0.0.1:8000/api/barang/{$id}";
            $response       = $client->request('PUT', $url, [
                'headers'   => ['Content-type' => 'application/json'],
                'body'      => json_encode($parameter)
            ]);

            $contentArray   = json_decode($response->getBody(), true);
            
            if($contentArray['status'] != true){
                $error = $contentArray['data'];
                return redirect()->to('barang.edit', $id)->withErrors($error);
            } 
            return redirect()->to('barang')->with('success', 'Sukses Mengupdate Data');
            
        } catch (\Exception $e){
            return redirect()->route('barang.edit', $id)->withErrors('Terjadi kesalahan saat mengupdate data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $client         = new Client();
            $url            = "http://127.0.0.1:8000/api/barang/{$id}";
            $response       = $client->request('DELETE', $url);
            $content        = $response->getBody()->getContents();
            $contentArray   = json_decode($content, true);

            if ($contentArray['status'] != true) {
                $error = $contentArray['data'];
                return redirect()->route('barang.index')->withErrors($error);
            } 

            return redirect()->route('barang.index')->with('success', 'Sukses Menghapus Data');
            
        } catch (\Exception $e) {
            return redirect()->route('barang.index')->withErrors('Terjadi kesalahan saat menghapus data.');
        }
    }

}
