@extends('layouts.frontend', compact('title'))

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url()">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>My Blog</h1>
                        <span class="subheading">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur quam voluptatem sapiente consequatur, amet reprehenderit, odio quisquam. Ex autem dolorem esse dolor, laboriosam reiciendis consectetur sint, ea iste, ipsam odio.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mx-auto">
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
                            <p>{!! substr($post->body, 1, 200) !!} ... <a href="{{ route('post', $post->slug) }}">Baca selengkapnya</a></p>
                            <p class="post-meta">Diposting oleh
                                <a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                {{ $post->created_at->diffForHumans() }}
                                &nbsp;
                                <i class="far fa-thumbs-up">
                                    {{ $post->likes->sum('likes') }}
                                </i>&nbsp;<i class="far fa-comment">
                                    {{-- {{ $post->comments->messages }} --}} 0
                                </i>
                            </p>
                        </div>
                    </div>
                @endforeach
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
