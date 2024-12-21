@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <section class="content">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mt-sm-4">
                                <div class="col-12 col-md-12 col-lg-5">
                                    <div class="card profile-widget">
                                        <div class="profile-widget-header">
                                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                                            <div class="profile-widget-items">
                                                <div class="profile-widget-item">
                                                    <div class="profile-widget-item-value">{{ $authSam->name }}</div>
                                                    <div class="text-muted font-weight-normal">{{ $authSam->role }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-widget-description">
                                            <div class="profile-widget-name">{{ $authSam->name }}
                                                <div class="text-muted d-inline font-weight-normal">
                                                    <div class="slash"></div> {{ $authSam->role }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-7">
                                    <div class="card">
                                        <form action="{{ route('updatePassword') }}" method="POST" class="needs-validation">
                                            @csrf
                                            @method('PUT')
                                            <div class="card-header">
                                                <h4>Ganti Password</h4>
                                            </div>
                                            <div class="card-body" id="gantiPassword">
                                                <div class="row">
                                                    <div class="form-group col-md-12 col-12">
                                                        <label for="password">Password Lama
                                                            <b class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</b>
                                                        </label>
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" name="password" id="password"
                                                                class="form-control @error('password') is-invalid @enderror repassword"
                                                                placeholder="Password Lama" required="">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-success text-white input-group-text show-password" data-input="password">
                                                                    <i class="fas fa-eye fa-fw"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-success text-white d-none input-group-text hide-password" data-input="password">
                                                                    <i class="fas fa-eye-slash fa-fw"></i>
                                                                </button>
                                                            </div>
                                                            @error('password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12 col-12">
                                                        <label for="password_baru">Password Baru
                                                            <b class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</b>
                                                        </label>
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" name="password_baru" id="password_baru"
                                                                class="form-control @error('password_baru') is-invalid @enderror repassword"
                                                                placeholder="Password Baru" required="">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-success text-white input-group-text show-password" data-input="password_baru">
                                                                    <i class="fas fa-eye fa-fw"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-success text-white d-none input-group-text hide-password" data-input="password_baru">
                                                                    <i class="fas fa-eye-slash fa-fw"></i>
                                                                </button>
                                                            </div>
                                                            @error('password_baru')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12 col-12">
                                                        <label for="password_baru_confirmation">Konfirmasi Password
                                                            <b class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</b>
                                                        </label>
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" name="password_baru_confirmation" id="password_baru_confirmation"
                                                                class="form-control @error('password_baru_confirmation') is-invalid @enderror repassword"
                                                                placeholder="Konfirmasi Password" required="">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-success text-white input-group-text show-password" data-input="password_baru_confirmation">
                                                                    <i class="fas fa-eye fa-fw"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-success text-white d-none input-group-text hide-password" data-input="password_baru_confirmation">
                                                                    <i class="fas fa-eye-slash fa-fw"></i>
                                                                </button>
                                                            </div>
                                                            @error('password_baru_confirmation')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card">
                                        <form action="{{ route('updateEmail') }}" method="POST" class="needs-validation">
                                            @csrf
                                            @method('PUT')
                                            <div class="card-header">
                                                <h4>Ganti Email</h4>
                                            </div>
                                            <div class="card-body" id="gantiEmail">
                                                <div class="row">
                                                    <div class="form-group col-md-12 col-12">
                                                        <label for="email">Email Lama
                                                            <b class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</b>
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="email" name="email" id="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                placeholder="Email Lama" value="{{ $authSam->email }}" required disabled>
                                                            @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12 col-12">
                                                        <label for="email_baru">Email Baru
                                                            <b class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</b>
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="email_baru" name="email_baru" id="email_baru"
                                                                class="form-control @error('email_baru') is-invalid @enderror"
                                                                placeholder="Email Baru" required="">
                                                            @error('email_baru')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12 col-12">
                                                        <label for="email_password">Password
                                                            <b class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</b>
                                                        </label>
                                                        <div class="input-group" id="show_hide_email_password">
                                                            <input type="password" name="email_password" id="email_password"
                                                                class="form-control @error('email_password') is-invalid @enderror"
                                                                placeholder="Password untuk Ganti Email" required="">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-success text-white input-group-text show-password" data-input="email_password">
                                                                    <i class="fas fa-eye fa-fw"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-success text-white d-none input-group-text hide-password" data-input="email_password">
                                                                    <i class="fas fa-eye-slash fa-fw"></i>
                                                                </button>
                                                            </div>
                                                            @error('email_password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

@section('plugins_js')
@endsection

@section('page_js')
<script>
    $(document).ready(function() {
        // Event untuk tombol "show-password"
        $('.show-password').on('click', function() {
            const inputId = $(this).data('input');
            const inputElement = $(`#${inputId}`);
            const hideButton = $(this).siblings('.hide-password');

            // Ubah tipe input menjadi text untuk menampilkan password
            if (inputElement.length) {
                inputElement.attr('type', 'text');
                $(this).addClass('d-none'); // Sembunyikan tombol show
                hideButton.removeClass('d-none'); // Tampilkan tombol hide
            }
        });

        // Event untuk tombol "hide-password"
        $('.hide-password').on('click', function() {
            const inputId = $(this).data('input');
            const inputElement = $(`#${inputId}`);
            const showButton = $(this).siblings('.show-password');

            // Ubah tipe input menjadi password untuk menyembunyikan password
            if (inputElement.length) {
                inputElement.attr('type', 'password');
                $(this).addClass('d-none'); // Sembunyikan tombol hide
                showButton.removeClass('d-none'); // Tampilkan tombol show
            }
        });
    });
</script>
@include('layouts.sweetalert')
@endsection