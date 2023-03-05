@extends('layouts.app')
@push('head')
@endpush

@section('body')
    <div class="row">
        <div class="col-md-12 mb-4">
            <form class="card p-2" method="get" action="/">
                <div class="form-group">
                    <label>Cari Buku :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Judul Buku" name="search" value="{{ Request::get('search') ?? "" }}">
                        <button type="submit" class="btn btn-secondary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <h4 class="mt-4">Data Buku :</h4>
        </div>
        @forelse ($data as $d)
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
                            <small class="text-muted"><span class="like-{{ $d->id }}">{{ $d->like }}</span>
                                Likes</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        <div class="col-md-12">
           Tidak ada buku yang dapat ditampilkan
        </div>
        @endforelse

    </div>
    <h4 class="mt-4">Lainnya :</h4>
    <div class="row">
        @foreach ($books->items as $b)
            <div class="col-md-4 mb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>{{ $b->volumeInfo->title }}</h5>
                        <p class="card-text">{{ isset($b->volumeInfo->description) ? Str::limit($b->volumeInfo->description, 50) : "Tidak ada deskripsi" }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ $b->volumeInfo->infoLink }}" class="btn btn-sm btn-outline-secondary like-btn"
                                    target="_blank">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@push('scripts')
    <script>
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
@endpush
