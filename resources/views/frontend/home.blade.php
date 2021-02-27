@extends('layouts.frontend', compact('title'))

@section('custom-scripts')
    <script src="{{ asset('frontend/vendor/sweetalert2/src/sweetalert2.js') }}"></script>
    <script></script>
@endsection

@section('content')
{{-- {{ dd($post->categories)}} --}}
    <!-- Page Header -->
    <header class="masthead" style="background-image: url()">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>IRP Blog</h1>
                        <span class="subheading">Sebuah tempat digital untuk sharing pemikiran, diskusi publik, dan interaksi sosial secara online.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mx-auto">
                @include('frontend.components.alert')
                @foreach ($posts as $post)
                    <div class="card-post my-3">
                        @if ($post->thumbnail)
                            <img src="{{ $post->takeImage }}" class="card-img-top" style="height: 250px; object-fit: cover; object-position: center;">
                        @endif
                        <div class="post-preview">
                            <a href="{{ route('post', $post->slug) }}">
                                <h3 class="post-title">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            <p>{!! Str::limit($post->body, 200) !!} <a href="{{ route('post', $post->slug) }}">Baca selengkapnya</a></p>
                            <p class="post-meta">
                                @foreach ($post->categories as $category)
                                    {{ $category->name }} -
                                @endforeach
                                Diposting oleh
                                <a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                {{ $post->created_at->diffForHumans() }}
                                &nbsp;
                                <i class="far fa-thumbs-up">
                                    {{ $post->likes->sum('likes') }}
                                </i>&nbsp;<i class="far fa-comment">
                                    {{ $post->comments->count('message') }}
                                </i>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4">
                <div class="card my-3">
                    <h3 class="post-title">Postingan Terakhir</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($posts as $post)
                            <li class="list-group-item">
                                <div>
                                    <a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                                </div>
                                <div>
                                    <a href="{{ route('user.show', $post->user->id) }}" class="text-comment">{{ $post->user->name }}</a><small class="text-comment"> - {{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card my-3">
                    <h3 class="post-title">Kategori</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($categories as $category)
                            <li class="list-group-item"><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Pager -->
        <div class="clearfix">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
