@extends('layouts.frontend', compact('title'))

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1 class="subheading">{{ $post->title }}</h1>
                        <h3 class="meta">{{ $post->meta_description}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    {!! $post->body !!}
                    <div class="card">
                        <div class="card-header">ADS</div>
                        <div class="card-body">
                            Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Quia sed officia, laborum odit, ullam accusamus labore, aperiam laboriosam provident dolorum molestias ipsa est numquam at dolores similique illo doloribus, necessitatibus.
                        </div>
                    </div>
                    <hr>

                    <!-- Comment -->
                    @foreach ($users as $user)
                        <div class="card my-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ $user->takeImage }}" class="rounded-circle" width="75" alt="">
                                </div>
                                <div class="col-md-10">
                                    <a href="">{{ $user->name }}</a>
                                    {{-- <div class="text-comment">{{ $user->comments->message }}</div> --}}
                                    {{-- <div class="text-comment">{{ $user->comments->created_at }}</div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="card my-3">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="" class="rounded-circle" width="75" alt="">
                            </div>
                            <div class="col-md-10">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="comment">Leave a comment</label>
                                        <textarea class="form-control" name="comment" id="comment" cols="20" rows="5"></textarea>
                                        <button type="submit" class="btn btn-success float-right mt-3">Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card my-3">
                        <h3>ADS</h3>
                    </div>
                    <div class="card my-3">
                        <h3 class="post-title">Related Posts</h3>
                        <ul class="list-group list-group-flush">
                            @foreach ($posts as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                                    <h1 class="text-comment">{{ $post->user->name }} | {{ date('d-m-Y', strtotime($post->created_at)) }}</h1>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card my-3">
                        <h3 class="post-title">Category</h3>
                        <ul class="list-group list-group-flush">
                            @foreach ($categories as $category)
                                 <li class="list-group-item"><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
