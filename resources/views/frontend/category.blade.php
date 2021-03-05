@extends('layouts.frontend', compact('title'))

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url()">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>{{ $category->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @include('frontend.components.alert')
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
                                <p class="">{!! Str::limit($post->body, 200) !!} Baca selengkapnya</p>
                            </a>
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
                    <h3>ADS</h3>
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
