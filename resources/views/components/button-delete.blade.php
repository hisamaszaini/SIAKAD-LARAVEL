<form action="{{ $link }}" method="post" class="d-inline delete-form">
    @method('delete')
    @csrf
    <button type="button" class="btn btn-icon btn-danger btn-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus Data!" data-id="{{ $link }}">
        <span class="pcoded-micon"> <i class="fas fa-trash"></i></span>
    </button>
</form>