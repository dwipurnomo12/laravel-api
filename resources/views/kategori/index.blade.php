@extends('layouts.main')

@section('content')
<div class="section-header">
    <h1>Kategori</h1>
    <div class="ml-auto">
        <a href="kategori/create" class="btn btn-primary">Tambah Kategori</a>
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

                @if (session()->has('error'))
                    <div class="alert alert-error alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="table_id" class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['kategori']}}</td>
                                    <td>
                                        <a href="/kategori/{{ $item['id'] }}/edit" class="btn btn-warning">Edit</a>
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
                        fetch(`/api/kategori/${id}`, {
                            method: 'DELETE',
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === true) {
                                Swal.fire('Sukses', 'Data berhasil dihapus.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', data.data, 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
                        });
                    }
                });
            });
        });
    });
</script>

@endsection