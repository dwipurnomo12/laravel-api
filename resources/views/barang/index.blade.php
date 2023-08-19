@extends('layouts.main')

@section('content')
<div class="section-header">
    <h1>Data Barang</h1>
    <div class="ml-auto">
        <a href="barang/create" class="btn btn-primary">Tambah Barang</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                      </button>
                      {{ session('success') }}
                    </div>
                  </div>
                @endif
                <div class="table-responsive">
                    <table id="table_id" class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nm_barang']}}</td>
                                    <td>Rp. {{ $item['hrg_beli'] }}</td>
                                    <td>Rp. {{ $item['hrg_jual'] }}</td>
                                    <td>
                                        <a href="/barang/{{ $item['id'] }}/edit" class="btn btn-warning">Edit</a>
                                        <button class="btn btn-danger delete-button" data-id="{{ $item['id'] }}">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Datatables Jquery -->
<script>
    $(document).ready(function(){
        $('#table_id').DataTable();
    })
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = button.getAttribute('data-id');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Anda yakin ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/barang`;
                    }
                });
            });
        });
    });
</script>
@endsection