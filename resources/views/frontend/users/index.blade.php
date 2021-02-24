@extends('layouts.frontend', compact('title'))

@section('custom-styles')
    <style>
    @media only screen and (min-width: 768px) {
        header.masthead .page-heading,
        header.masthead .post-heading,
        header.masthead .site-heading {
            padding: 50px 0;
        }
    }

    header.masthead .page-heading,
    header.masthead .post-heading,
    header.masthead .site-heading {
        padding: 100px 0 50px;
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
                        <h1>Profil Saya</h1>
                        <span class="subheading">{{ $user->name }}</span>
                        <a href="{{ route('post.create') }}" class="btn btn-success btn-lg mt-3">Create a Post</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card my-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="{{ $user->takeImage }}" class="img-thumbnail rounded-circle" width="100">
                        </div>
                        <p>{{ $user->bio }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card my-3">
                    <div class="card-header">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-dark float-right"><i class="fas fa-cogs"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Name</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                {{ $user->name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Jenis Kelamin</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                {{ $user->gender == 'L' ? 'Laki-Laki' : 'Perempuan'}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Umur</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                {{ $user->age }} Tahun
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Email</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                {{ $user->email }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Daftar</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                Since : {{ date('m-d-Y', strtotime($user->created_at))}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Like</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                <h6>{{ $likes->sum('likes') }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Coment</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                <h6>{{ count($user->comments) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($posts as $post)
                    <div class="card my-3">
                        <img src="{{ $post->thumbnail }}" class="card-img-top" style="height: 250px; object-fit: cover; object-position: center;" alt="">
                        <div class="post-preview">
                            <a href="{{ route('post', $post->slug) }}">
                                <h2 class="post-title">
                                    {{ $post->title }}
                                </h2>
                                <p class="">{!! $post->body !!}...Baca selengkapnya</p>
                            </a>
                            <p class="post-meta">Posted by
                                <a href="{{ route('user.show', $user->id) }}">{{ $post->user->name }}</a>
                                on September 24, 2019
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm" style="color: white;">Edit <i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-danger btn-sm" style="color: white;">Delete <i class="fas fa-trash"></i></a>
                        </p>
                        </div>
                    </div>
                @endforeach
            {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
