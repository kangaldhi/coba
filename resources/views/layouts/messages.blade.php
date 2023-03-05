@if (Session::has('pesan'))
<div
    class="alert alert-{{ Session::get('jenis') }} alert-has-icon alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        {{ Session::get('pesan') }}
    </div>
</div>
@endif
