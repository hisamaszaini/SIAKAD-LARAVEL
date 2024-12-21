@extends('layouts.stislaauth', ['title' => 'Login'])

@section('content')
<div class="card card-primary">
    <div class="card-header text-center">
        <h4>SISTEM INFOMASI MANAJEMEN SEKOLAH</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
<div class="mt-5 text-muted text-center">
    Apakah kamu punya masalah? Hubungi admin <a href="#">di sini</a>
</div>
@endsection