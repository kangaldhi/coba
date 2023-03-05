<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Home</title>
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>

    <header>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="/" class="navbar-brand d-flex align-items-center">
                    <strong>Home</strong>
                </a>
                @if (Auth::guard('admin')->check())
                    <a href="{{ route('admin.buku.index') }}" class="navbar-brand d-flex align-items-center">
                        <strong>Home</strong>
                    </a>
                @else
                    <a href="/" class="navbar-brand d-flex align-items-center">
                        <strong>Login</strong>
                    </a>
                @endif
            </div>
        </div>
    </header>

    <main>


        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card p-2">
                            <div class="form-group">
                                <label>Cari Buku :</label>
                                <div class="input-group mt-2">
                                    <input type="text" class="form-control" id="search" placeholder="Judul Buku"
                                        name="search" value="{{ Request::get('search') ?? '' }}">
                                    <button type="submit" class="btn btn-primary btn-search">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h4 class="mt-4">Data Buku :</h4>
                    </div>
                    <div class="result-data row">

                    </div>
                    {{-- @forelse ($data as $d)
                        <div class="col-md-4">
                            <div class="card shadow-sm">

                                <div class="card-body">
                                    <h5>{{ $d->nama_buku }}</h5>
                                    <p class="card-text">{{ $d->deskripsi }}.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary like-btn"
                                                onclick="like({{ $d->id }})">Like</button>
                                        </div>
                                        <small class="text-muted"><span
                                                class="like-{{ $d->id }}">{{ $d->like }}</span>
                                            Likes</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            Tidak ada buku yang dapat ditampilkan
                        </div>
                    @endforelse --}}

                </div>
                <h4 class="mt-4">Lainnya :</h4>
                <div class="row">
                    @foreach ($books->items as $b)
                        <div class="col-md-4 mb-2">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ $b->volumeInfo->imageLinks->thumbnail }}"
                                                style="max-width: 100%;">
                                        </div>
                                        <div class="col-md-8">
                                            <h5>{{ $b->volumeInfo->title }}</h5>
                                            <p class="card-text">
                                                {{ isset($b->volumeInfo->description) ? Str::limit($b->volumeInfo->description, 50) : 'Tidak ada deskripsi' }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="{{ $b->volumeInfo->infoLink }}"
                                                        class="btn btn-sm btn-outline-secondary like-btn"
                                                        target="_blank">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        </div>
    </footer>


    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('document').ready(function() {
            load_data();
        });

        $('.btn-search').click(function() {
            var search = $('#search').val();
            load_data(search);
        });

        function load_data(search = null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    Accept: "application/json",
                },
                type: 'POST',
                url: "{{ route('get_data') }}",
                data: {
                    'search': search,
                },
                success: (result) => {
                    if (result.success == true) {
                        var resultData = result.data;
                        var content = "";

                        if (resultData.length > 0) {
                            resultData.forEach((data) => {
                                content += `<div class="col-md-4">
                                    <div class="card shadow-sm">

                                        <div class="card-body">
                                            <h5>${data.nama_buku}</h5>
                                            <p class="card-text">${data.nama_buku}.</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary like-btn"
                                                        onclick="like(${data.id})">Like</button>
                                                </div>
                                                <small class="text-muted"><span
                                                        class="like-${data.id}">${data.like}</span>
                                                    Likes</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            });
                        } else {
                            content = `<div class="col-md-4">
                                    Tidak ada data yang dapat ditampilkan
                                </div>`
                        }


                        $('.result-data').html(content);
                    }
                },
                error: function(result) {

                },
            });
        }

        function like(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    Accept: "application/json",
                },
                type: 'POST',
                url: "{{ route('like') }}",
                data: {
                    'id': id,
                },
                success: (result) => {
                    if (result.success == true) {
                        $('.like-' + id).html(result.like_count)
                    }
                },
                error: function(result) {

                },
            });
        }
    </script>
</body>

</html>
