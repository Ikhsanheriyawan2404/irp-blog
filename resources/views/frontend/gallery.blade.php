@extends('layouts.frontend', compact('title'))

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ asset('img/img3.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>IRP</h1>
                        <span class="subheading">Kumpulan galeri dokumentasi acara kegiatan Ikatan Remaja Penangsian</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            @foreach ($galleries as $gallery)
                <div class="col-lg-4">
                    <div class="card my-3">
                        <img src="{{ $gallery->takeImage }}">
                        <p class="caption">{{ $gallery->caption }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $galleries->links() }}
    </div>
@endsection
