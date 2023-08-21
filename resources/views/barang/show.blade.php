@extends('layouts.main')

@section('content')
<div class="section-header">
    <h1>Edit Data Barang</h1>
    <div class="ml-auto">
        <a href="/barang" class="btn btn-primary">Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Barang <span style="color: red">*</span></label>
                    <input type="text" class="form-control @error('nm_barang') is-invalid @enderror" name="nm_barang" id="nm_barang" value="{{ old('nm_barang', $data['nm_barang']) }}" disabled>
                </div>
                <div class="form-group">
                    <label>Harga Beli <span style="color: red">*</span></label>
                    <input type="number" class="form-control @error('hrg_beli') is-invalid @enderror" name="hrg_beli" id="hrg_beli" value="{{ old('hrg_beli', $data['hrg_beli']) }}" disabled>
                </div>
                <div class="form-group">
                    <label>Harga Jual <span style="color: red">*</span></label>
                    <input type="number" class="form-control @error('hrg_jual') is-invalid @enderror" name="hrg_jual" id="hrg_jual" value="{{ old('hrg_jual',$data['hrg_jual']) }}" disabled>
                </div>
                <div class="form-group">
                    <label>Deskripsi <span style="color: red">*</span></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" disabled>{{ old('deskripsi', $data['nm_barang']) }}</textarea>
                </div>  
                <div class="form-group">
                    <label>kategori</label>
                    <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" disabled>
                      <option value=""> -- Pilih Kategori -- </option>
                      @foreach ($kategories as $kategori)
                        <option value="{{ $kategori['id'] }}" {{ $data['kategori_id'] == $kategori['id'] ? 'selected' : '' }}> 
                            {{ $kategori['kategori'] }} 
                        </option>
                      @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection