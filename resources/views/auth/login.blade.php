@extends('layouts.frontend')

@section('custom-styles')
    <style>
        header.masthead .page-heading,
        header.masthead .post-heading,
        header.masthead .site-heading {
            padding: 80px 0 20px;
            color: white;
        }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url()">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Masuk</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10 mx-auto">
                <div class="card my-3">
                    @include('components.alert')
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password <small class="text-danger">*</small></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div>
                                @if (Route::has('password.request'))
                                    <label><a href="{{ route('password.request') }}">Forgot password</a></label>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">Masuk</button>
                    </form>
                    <div class="d-flex jutify-content-center text-comment">
                        Belum punya akun ?<a href="{{ route('register') }}">Daftar disini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
