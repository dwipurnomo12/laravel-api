<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use function Ramsey\Uuid\v1;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $client         = new Client();
            $url            = "http://127.0.0.1:8000/api/kategori";
            $response       = $client->request('GET', $url);
            $content        = $response->getBody()->getContents();
            $contentArray   = json_decode($content, true);
    
            if ($contentArray['status'] != true) {
                $error = $contentArray['data'];
                return redirect()->route('kategori.index')->withErrors($error);
            }
    
            $data = $contentArray['data'];
    
            return view('kategori.index', [
                'data'  => $data
            ]);
    
        } catch (\Exception $e) {
            return redirect()->route('kategori.index')->withErrors('Terjadi kesalahan saat menampilkan data.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori'  => 'required'
        ], [
            'kategori'  => 'Kolom Kategori Wajib Diisi !'
        ]);

        if ($validator->fails()) {
            return redirect()->route('kategori.create')->withErrors($validator)->withInput();
        }

        $kategori = [
            'kategori'  => $request->kategori
        ];

        try{
            $client     = new Client();
            $url        = "http://127.0.0.1:8000/api/kategori";
            $response   = $client->request('POST', $url, [
                'headers'   => ['Content-type'  => 'application/json'],
                'body'      => json_encode($kategori)
            ]);
            $content        = $response->getBody()->getContents();
            $contentArray   = json_decode($content, true);

            if($contentArray['status'] != true){
                $error = $contentArray['data'];
                return redirect()->to('kategori.index')->withErrors($error);
            }else{
                return redirect()->to('kategori')->with('success', 'Data Berhasil Ditambahkan');
            }
        } catch (\Exception $e){
            return redirect()->route('kategori.index')->withErrors('Terjadi kesalahan saat mengambil data.');
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
            $url            = "http://127.0.0.1:8000/api/kategori/{$id}";
            $response       = $client->request('GET', $url);
            $content        = $response->getBody()->getContents();
            $contentArray   = json_decode($content, true);

            if($contentArray['status'] != true){
                $error = $contentArray['data'];
                return redirect()->route('kategori.index')->withErrors($error);
            }
            $data           = $contentArray['data'];

            return view('kategori.edit', compact('data'));
        } catch(\Exception $e){
            return redirect()->route('kategori.index')->withErrors('Terjadi kesalahan saat mengambil data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'kategori'  => 'required'
        ], [
            'kategori'  => 'Kolom Kategori Wajib Diisi !'
        ]);

        if ($validator->fails()) {
            return redirect()->route('kategori.create')->withErrors($validator)->withInput();
        }

        $kategori = [
            'kategori'  => $request->kategori
        ];

        try{
            $client     = new Client();
            $url        = "http://127.0.0.1:8000/api/kategori/{$id}";
            $response   = $client->request('PUT', $url, [
                'headers'   => ['Content-type'  => 'application/json'],
                'body'      => json_encode($kategori)
            ]);
            $content        = $response->getBody()->getContents();
            $contentArray   = json_decode($content, true);

            if($contentArray['status'] != true){
                $error = $contentArray['data'];
                return redirect()->to('kategori.index')->withErrors($error);
            }else{
                return redirect()->to('kategori')->with('success', 'Data Berhasil Ditambahkan');
            }
        } catch (\Exception $e){
            return redirect()->route('kategori.index')->withErrors('Terjadi kesalahan saat mengambil data.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $client         = new Client();
            $url            = "http://127.0.0.1:8000/api/barang/{$id}";
            $response       = $client->request('DELETE', $url);
            $content        = $response->getBody()->getContents();
            $contentArray   = json_decode($content, true);

            if($contentArray['status'] != true) {
                $error  = $contentArray['data'];
                return redirect()->route('kategori.index')->withErrors($error);
            }

            return redirect()->route('kategori.index')->with('success', 'Berhsil Menghapus Data');
            
        } catch(\Exception $e) {
            return redirect()->route('kategori.index')->withErrors('Terjadi Kesalahan Saat Menghapus Data');
        }
    }
}
