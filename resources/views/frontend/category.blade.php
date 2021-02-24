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
    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mx-auto">
                <div class="card-post my-3">
                    @foreach ($posts as $post)
                        <img src="{{ $post->thumbnail }}" class="card-img-top" style="height: 250px; object-fit: cover; object-position: center;" alt="">
                        <div class="post-preview">
                            <a href="{{ route('post', $post->slug) }}">
                                <h3 class="post-title">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            <p class="">{{ substr($post->body, 1, 100) }} ... <a href="{{ route('post', $post->slug) }}">Baca selengkapnya</a></p>
                            <p class="post-meta">Posted by
                                <a href="">{{ $post->user->name }}</a>
                                {{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card my-3">
                    <h3 class="post-title">Recent Posts</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($posts as $post)
                            <li class="list-group-item">
                                <a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                                <h1 class="text-comment">{{ $post->user->name }} - {{ date('Y-m-d', strtotime($post->crated_at))}}</h1>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card my-3">
                    <h3 class="post-title">Category</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($categories as $category)
                            <li class="list-group-item"><a href="">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Pager -->
        <div class="clearfix">
            {{ $posts->links() }}
        </div>
    </div> --}}
@endsection
