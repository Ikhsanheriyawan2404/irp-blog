@extends('layouts.frontend', compact('title'))

@section('meta')
    <meta name="title" content="{{ $post->meta_title ?? 'IRP Blog' }}">
    <meta name="description" content="{{ $post->meta_description ?? 'Sebuah sarana blog publik untuk saling berbagi - Remaja generasi millenial bisa' }}">
    <meta name="keyword" content="{{ $post->meta_keyword ?? 'Forum, Remaja, IRP' }}">
@endsection

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ $post->takeImage }})">
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
                    <div class="card my-3">
                        <div class="card-header">ADS</div>
                        <div class="card-body">
                            Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Quia sed officia, laborum odit, ullam accusamus labore, aperiam laboriosam provident dolorum molestias ipsa est numquam at dolores similique illo doloribus, necessitatibus.
                        </div>
                    </div>
                    <div class="my-5">
                        <h1>{{ $post->title }}</h1>
                        <small class="text-comment"> Penulis : <a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a>;
                            Kategori : @foreach ($post->categories as $category) {{ $category->name }};@endforeach
                            Terbit : {{ date('d-m-Y', strtotime($post->created_at)) }};
                            <div class="d-flex justify-content-left">
                                @can('update', $post)
                                    <a class="btn btn-success btn-sm mr-2" href="{{ route('post.edit', $post->slug) }}">edit <i class="fas fa-pencil-alt"></i></a>
                                @endcan
                                @can('delete', $post)
                                    <form action="{{ route('post.delete', $post->slug) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah yakin ingin menghapus postingan ini?')">hapus <i class="fas fa-trash"></i></button>
                                    </form>
                                @endcan
                            </div>
                        </small>
                        <hr>
                        @if ($post->thumbnail)
                            <img src="{{ $post->takeImage }}" class="img-fluid">
                        @endif
                        {!! $post->body !!}
                    </div>
                    <!-- Button Like -->
                        <div class="d-flex justify-content-between">
                            @if (auth()->user() == null)
                                <div>
                                    <form action="{{ route('post.like', $post->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Like <i class="far fa-thumbs-up"></i></button>
                                    </form>
                                </div>
                            @else
                                @if ($likes->where('user_id', auth()->user()->id)->count() > 0)
                                    <div>
                                        <form action="#">
                                            <button class="btn btn-success" disabled>Like <i class="fas fa-check"></i></button>
                                        </form>
                                    </div>
                                @else
                                    <div>
                                        <form action="{{ route('post.like', $post->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Like <i class="far fa-thumbs-up"></i></button>
                                        </form>
                                    </div>
                                @endif
                            @endif
                            <div>
                                <i class="fas fa-thumbs-up"></i> {{ $post->likes->sum('likes') }}
                                &nbsp;
                                <i class="fas fa-comment"></i> {{ $post->comments->count('message') }}
                            </div>
                        </div>
                    <hr>

                    <!-- Comment -->
                    @foreach ($post->comments as $comment)
                        <div class="card my-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ $comment->user->takeImage }}" class="rounded-circle" width="75" alt="">
                                </div>
                                <div class="col-md-10">
                                    <a href="">{{ $comment->user->name }}</a>
                                    <div class="text-comment">{{ $comment->message }}</div>
                                    <div class="text-comment">{{ $comment->created_at->diffForHumans() }}
                                        @can('delete', $comment)
                                            <form action="{{ route('comment.delete', $comment->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus komentar ini?')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="card my-3">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ auth()->user()->takeImage ?? '' }}" class="rounded-circle" width="75" alt="">
                            </div>
                            <div class="col-md-10">
                                <form action="{{ route('comment.store', $post->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">Berikan komentar</label>
                                        <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="comment" cols="10" rows="3"></textarea>
                                        @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                        <h3 class="post-title">Postingan Terkait</h3>
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
                    {{-- <div class="card my-3">
                        <h3 class="post-title">Category</h3>
                        <ul class="list-group list-group-flush">
                            @foreach ($categories as $category)
                                 <li class="list-group-item"><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </article>

    <!-- Modal Edit -->
    {{-- <div class="modal fade" id="edit-comment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('comment.update', $comment->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <textarea class="form-control" name="comment" id="comment" data-id="" cols="10" rows="3" autofocus required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit Komentar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    {{-- Modal Delete --}}
    {{-- <div class="modal fade" id="delete-comment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Apakah kamu yakin? komentar ini akan terhapus.</p>
                </div>
                <form action="{{ route('comment.delete', $comment->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    {{-- @section('custom-scripst')
        <script>
            $(document).ready(function () {
                let
            });
        </script>
    @endsection --}}
@endsection
