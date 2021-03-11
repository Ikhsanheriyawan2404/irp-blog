@extends('layouts.frontend', compact('title'))

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('frontend/vendor/select2/dist/css/select2.min.css') }}">
    <style>
        .select2 {
            width:100%!important;
        }

        header.masthead .page-heading,
        header.masthead .post-heading,
        header.masthead .site-heading {
            padding: 100px 0 50px;
            color: white;
        }
    </style>
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
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
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
                @include('frontend.posts.partials.form-control')
                <button type="submit" class="btn btn-success float-right">Tambah <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection
