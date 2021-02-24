@extends('layouts.frontend', compact('title'))

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('frontend/vendor/select2/dist/css/select2.min.css') }}">
@endsection

@section('custom-scripts')
    <script src="{{ asset('frontend/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('frontend/vendor/ckeditor5/ckeditor.js.map') }}"></script>
    <script src="{{ asset('frontend/vendor/ckeditor5/translations/id.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#category').select2({
                placeholder: 'Choose Category'
            });
        });
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#body' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                }
            } )
            .catch( error => {
                console.log( error );
            } );
    </script>
@endsection

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url()">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Tambah Postingan Baru</h1>
                        <div>
                            <a href="{{ route('home') }}" style="color: white;">Home</a> / <a href="" style="color: white;">Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto my-3">
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title <small class="text-danger">*</small></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Deskripsi <small class="text-secondary">tidak wajib diisi</small></label>
                        <input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description">
                        @error('meta_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">Kata Kunci <small class="text-secondary">boleh kosong</small></label>
                        <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" id="meta_keyword">
                        @error('meta_keyword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail <small class="text-secondary">boleh kosong</small></label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail">
                        @error('thumbnail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Category <small class="text-danger">*</small></label>
                        <select type="text" class="form-control category @error('category') is-invalid @enderror" name="category[]" id="category" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Body <small class="text-danger">*</small></label>
                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" value="{{ old('body') }}"></textarea>
                        @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success float-right">Tambah</button>
                </form>
            </div>
        </div>
    </div>
@endsection
