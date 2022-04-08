@extends('layouts.frontend', compact('title'))

@section('custom-styles')
    <style>
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
                        @if (auth()->user()->id == $user->id)
                            <a href="{{ route('post.create') }}" class="btn btn-success btn-lg mt-3">Buat Postingan</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('frontend.components.alert')
                <div class="card my-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="{{ $user->takeImage }}" class="rounded-circle" height="100" width="100">
                        </div>
                        <p>{{ $user->bio }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card my-3">
                    <div class="card-header">
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-dark float-right">Edit Profil <i class="fas fa-cogs"></i></a>
                        @endif
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
                                <h6>Menyukai</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                {{-- <h6>{{ $likes->sum('likes') }}</h6> --}}
                                <h6>{{ count($user->likes) }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Mengomentari</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                <h6>{{ count($user->comments) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($posts as $post)
                    <div class="card my-3">
                        @if ($post->thumbnail)
                            <img src="{{ $post->takeImage }}" class="card-img-top" style="height: 250px; object-fit: cover; object-position: center;">
                        @endif
                        <div class="post-preview">
                            <a href="{{ route('post', $post->slug) }}">
                                <h2 class="post-title">
                                    {{ $post->title }}
                                </h2>
                                <p class="">{!! Str::limit($post->body, 100) !!} Baca selengkapnya</p>
                            </a>
                            <p class="post-meta">Diposting oleh
                                <a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                {{ $post->created_at->diffForHumans() }}
                                &nbsp;
                                <i class="far fa-thumbs-up">
                                    {{ $post->likes->sum('likes') }}
                                </i>&nbsp;<i class="far fa-comment">
                                    {{ $post->comments->count('message') }}
                                </i>
                                <div class="d-flex float-right">
                                    @can('update', $post)
                                        <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-success btn-sm mr-2">Edit <i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('delete', $post)
                                        <form action="{{ route('post.delete', $post->slug) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus postingan ini?')">Delete <i class="fas fa-trash"></i></button>
                                        </form>
                                        {{-- <a href="" class="btn btn-danger btn-sm delete-button" data-slug={{ $post->slug }}>Hapus <i class="fas fa-trash"></i></a> --}}
                                    @endcan
                                </div>
                            </p>
                        </div>
                    </div>
                @endforeach
            {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
