@extends('layouts.main')

@section('content')
<div class="section-header">
    <h1>Data Barang</h1>
    <div class="ml-auto">
        <a href="/barang" class="btn btn-primary">Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="/kategori" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                        <label>Kategori <span style="color: red">*</span></label>
                        <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori" value="{{ old('kategori') }}">
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                                    
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </form>
                             
            </div>
        </div>
    </div>
</div>

@endsection