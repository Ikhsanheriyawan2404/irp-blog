<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fav Icon -->
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('frontend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Fonts Google Api -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="{{ asset('frontend/css/clean-blog.css') }}" rel="stylesheet">
    @yield('custom-styles')

</head>
<body>

    <!-- Navigation -->
    @include('frontend.components.navbar')

    <!-- Main Content -->
    @yield('content')
    {{-- <hr> --}}

    <!-- Footer -->
    @include('frontend.components.footer')

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('frontend/js/clean-blog.min.js') }}"></script>
    @yield('custom-scripts')

</body>
</html>
