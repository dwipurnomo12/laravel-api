@extends('layouts.main')

@section('content')
<div class="section-header">
    <h1>Edit Data Kategori</h1>
    <div class="ml-auto">
        <a href="/kategori" class="btn btn-primary">Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="/kategori/{{ $data['id'] }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                
                    <div class="form-group">
                        <label>Kategori <span style="color: red">*</span></label>
                        <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori" value="{{ old('kategori', $data['kategori']) }}">
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                                    
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </form>
                             
            </div>
        </div>
    </div>
</div>

@endsection