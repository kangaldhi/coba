@extends('layouts.app')
@section('title')
    Tambah
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
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                @yield('title')
                            </h3>
                        </div>
                        <form method="post" action="{{ route('admin.buku.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Buku</label>
                                    <input type="text" class="form-control" name="nama_buku" placeholder="Nama Buku">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Buku</label>
                                    <textarea type="text" class="form-control" name="deskripsi_buku" placeholder="Deskripsi Buku"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
