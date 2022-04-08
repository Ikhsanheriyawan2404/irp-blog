@extends('layouts.frontend', compact('title'))

@section('custom-styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');
        html,
        body {
            height: 100%
        }

        body {
            display: grid;
            background: #fff;
            font-family: 'Manrope', sans-serif
        }

        .mydiv {
            margin-top: 50px;
            margin-bottom: 50px
        }

        .cross {
            font-size: 10px
        }

        .padding-0 {
            padding-right: 5px;
            padding-left: 5px
        }

        .img-style {
            margin-left: -11px;
            box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            max-width: 104% !important
        }

        .m-t-20 {
            margin-top: 20px
        }

        .bbb_background {
            background-color: #E0E0E0 !important
        }

        .ribbon {
            width: 150px;
            height: 150px;
            overflow: hidden;
            position: absolute
        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 34px;
            border-radius: 50%;
            padding: 8px 0;
            background-color: #4BB543;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            color: #fff;
            font: 100 18px/1 'Lato', sans-serif;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
            text-transform: uppercase;
            text-align: center
        }

        .ribbon-top-right {
            top: -10px;
            right: -10px
        }

        .ribbon-top-right::before,
        .ribbon-top-right::after {
            border-top-color: transparent;
            border-right-color: transparent
        }

        .ribbon-top-right::before {
            top: 0;
            left: 17px
        }

        .ribbon-top-right::after {
            bottom: 17px;
            right: 0
        }

        .ribbon-top-right span {
            right: 17px;
            top: 17px
        }

        div {
            display: block;
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        .bbb_deals_featured {
            width: 100%
        }

        .bbb_deals {
            width: 100%;
            margin-right: 7%;
            padding-top: 80px;
            padding-left: 25px;
            padding-right: 25px;
            padding-bottom: 34px;
            box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 0px
        }

        .bbb_deals_title {
            position: absolute;
            top: 10px;
            left: 22px;
            font-size: 18px;
            font-weight: 500;
            color: #000000
        }

        .bbb_deals_slider_container {
            width: 100%
        }

        .bbb_deals_item {
            width: 100% !important
        }

        .bbb_deals_image {
            width: 100%
        }

        .bbb_deals_image img {
            width: 100%
        }

        .bbb_deals_content {
            margin-top: 33px
        }

        .bbb_deals_item_category a {
            font-size: 14px;
            font-weight: 400;
            color: rgba(0, 0, 0, 0.5)
        }

        .bbb_deals_item_price_a {
            font-size: 14px;
            font-weight: 400;
            color: rgba(0, 0, 0, 0.6)
        }

        .bbb_deals_item_price_a strike {
            color: red
        }

        .bbb_deals_item_name {
            font-size: 24px;
            font-weight: 400;
            color: #000000
        }

        .bbb_deals_item_price {
            font-size: 24px;
            font-weight: 500;
            color: #6d6e73
        }

        .available {
            margin-top: 19px
        }

        .available_title {
            font-size: 16px;
            color: rgba(0, 0, 0, 0.5);
            font-weight: 400
        }

        .available_title span {
            font-weight: 700
        }

        @media only screen and (max-width: 991px) {
            .bbb_deals {
                width: 100%;
                margin-right: 0px
            }
        }

        @media only screen and (max-width: 575px) {
            .bbb_deals {
                padding-left: 15px;
                padding-right: 15px
            }

            .bbb_deals_title {
                left: 15px;
                font-size: 16px
            }

            .bbb_deals_slider_nav_container {
                right: 5px
            }

            .bbb_deals_item_name,
            .bbb_deals_item_price {
                font-size: 20px
            }
        }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ asset('img/img3.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>IRP</h1>
                        <span class="subheading">Produk Kami</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="my-2">
                    <form class="form-inline" action="{{ route('product.search', []) }}">
                        <input class="form-control col-9" type="search" placeholder="Cari barang disini..." aria-label="Search" name="query">
                        <button class="btn btn-outline-success ml-2" type="submit">Cari</button>
                    </form>
                </div>
                <div class="form-group">
                    <form class="form-inline" action="{{ route('product.filter', []) }}">
                        <select class="form-control col-9" name="filter" id="filter" onchange="getValue()">
                            <option selected disabled>--Cari Berdasarkan Toko--</option>
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-success ml-2" type="submit">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($products as $product)

            <div class="col-md-4 my-3">
            <!-- bbb_deals -->
                <div class="bbb_deals">
                    <div class="ribbon ribbon-top-right"><span>{{ $product->discount }}<small class="cross">%</small></span></div>
                    <div class="bbb_deals_title">Diskon Hari Ini</div>
                    <div class="bbb_deals_slider_container">
                        <div class=" bbb_deals_item">
                            <div class="bbb_deals_image"><img src="{{ $product->takeImage }}"></div>
                            <div class="bbb_deals_content">
                                <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                    <div class="bbb_deals_item_category"><a href="#">{{ $product->shop->name }}</a></div>
                                    <div class="bbb_deals_item_price_a ml-auto"><strike>Rp. {{ $product->price }}</strike></div>
                                </div>
                                <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                    <div class="bbb_deals_item_name">{{ $product->name }}</div>
                                    <div class="bbb_deals_item_price ml-auto">{{ $product->price - $product->price * ($product->discount / 100) }}</div>
                                </div>
                                <div class="available">
                                    <div class="available_line d-flex flex-row justify-content-start">
                                        <div class="available_title">{{ $product->description }} <span></span></div>
                                        <div class="sold_stars ml-auto">
                                            <a href="https://wa.me/{{ $product->shop->number }}" class="btn btn-success">Beli
                                                {{-- <i class="fas fa-wallet"></i> --}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="available_bar"><span style="width:17%"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        function getValue () {
            let selectValue = document.getElementById('filter').value;
        }
    </script>
@endsection
