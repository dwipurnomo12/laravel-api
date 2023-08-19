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
                <form method="POST" action="/barang" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                        <label>Nama Barang <span style="color: red">*</span></label>
                        <input type="text" class="form-control @error('nm_barang') is-invalid @enderror" name="nm_barang" id="nm_barang" value="{{ old('nm_barang') }}">
                        @error('nm_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Harga Beli <span style="color: red">*</span></label>
                        <input type="number" class="form-control @error('hrg_beli') is-invalid @enderror" name="hrg_beli" id="hrg_beli" value="{{ old('hrg_beli') }}">
                        @error('hrg_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Harga Jual <span style="color: red">*</span></label>
                        <input type="number" class="form-control @error('hrg_jual') is-invalid @enderror" name="hrg_jual" id="hrg_jual" value="{{ old('hrg_jual') }}">
                        @error('hrg_jual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Deskripsi <span style="color: red">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
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