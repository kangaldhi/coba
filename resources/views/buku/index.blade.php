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
                            <table class="table table-bordered table-striped", id="datatables">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Buku</th>
                                        <th>Deskripsi</th>
                                        <th>Like</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($data as $d)
                                   <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->nama_buku }}</td>
                                        <td>{{ $d->deskripsi }}</td>
                                        <td>{{ $d->like }}</td>
                                        <td>
                                            <a href="{{ route('admin.buku.edit', $d->id) }}" class="btn btn-primary btn-sm"><i
                                                    class="nav-icon fas fa-pen"></i></a>
                                            <form action="{{ route('admin.buku.destroy', $d->id) }}"
                                                method="POST" class="d-inline"
                                                id="form-delete-{{ $d->id }}">
                                                @method('delete')
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="hapus({{ $d->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')

@endpush
