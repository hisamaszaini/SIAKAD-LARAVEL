<script>
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: '{{ session('success') }}',
        showConfirmButton: true,
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        showConfirmButton: true,
    });
    @endif

    $(document).ready(function() {
        $('#chkCheckAll').on('click', function() {
            $('.checkBoxClass').prop('checked', this.checked);
        });

        $('.checkBoxClass').on('click', function() {
            $('#chkCheckAll').prop('checked', $('.checkBoxClass:checked').length === $('.checkBoxClass').length);
        });

        $('#deleteAllSelectedRecord').on('click', function(e) {
            e.preventDefault();
            var selectedIds = $('.checkBoxClass:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Silakan pilih data yang ingin dihapus.',
                    showConfirmButton: true,
                });
                return;
            }

            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang dipilih akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/admin/dataguru/multidel',
                        data: {
                            ids: selectedIds,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    showConfirmButton: true,
                                });
                                location.reload();
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: xhr.responseJSON.message || 'Gagal menghapus data.',
                                showConfirmButton: true,
                            });
                        }
                    });
                }
            });
        });
    });

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var form = $(this).closest('.delete-form');
        var link = $(this).data('id');

        Swal.fire({
            title: 'Anda yakin?',
            text: "Data ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>