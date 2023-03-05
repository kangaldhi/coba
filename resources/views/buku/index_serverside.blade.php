@extends('layouts.app')
@section('title')
    List Buku
@endsection
@push('head')
@endpush

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@yield('title')</h3>
                        </div>
                        <div class="card-body">
                            @include('layouts.messages')
                            <a href="{{ route('admin.buku.create') }}" class="btn btn-primary mb-4">Tambah</a>
                            <table class="table table-bordered table-striped tableku">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Buku</th>
                                        <th>Deskripsi</th>
                                        <th>Like</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var table = $('.tableku').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.buku.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_buku',
                        name: 'nama_buku'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'like',
                        name: 'like'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $('body').on('click', '.tombol-delete', function() {
            var idnya = $(this).data("id");
            swal.fire({
                    title: 'Apakah Anda Yakin ?',
                    text: 'Jika terhapus, maka data tidak dapat di kembalikan !',
                    icon: 'warning',
                    dangerMode: true,
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: '/admin/buku/' + idnya,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": "DELETE"
                            },
                            success: function(data) {
                                var oTable = $('.tableku').dataTable();
                                oTable.fnDraw(false);
                                Swal.fire(
                                    'Berhasil',
                                    'Data Plot Kunjungan berhasil dihapus',
                                    'success'
                                )
                            },
                            error: function(data) {
                                Swal.fire(
                                    'Gagal',
                                    'Gagal menghapus Data karena sedang digunakan atau ada kesalahan lain',
                                    'error'
                                )
                            }
                        });
                    }
                });
        });
    </script>
@endpush
