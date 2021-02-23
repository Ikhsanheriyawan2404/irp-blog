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
                <div class="card-post my-3">
                        <img src="img/img1.png" class="card-img-top" style="height: 250px; object-fit: cover; object-position: center;" alt="">
                        <div class="post-preview">
                            <a href="post.html">
                                <h3 class="post-title">
                                    Man must explore, and this is exploration at its greatest
                                </h3>
                            </a>
                            <p class="">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea ad aliquid nulla expedita labore, quo at repellat dicta, accusamus molestiae illum perspiciatis voluptas sed magni velit dolorem minima, quidem harum.</p>
                            <p class="post-meta">Posted by
                                <a href="#">Start Bootstrap</a>
                                on September 24, 2019</p>
                        </div>
                </div>
                <div class="card-post my-3">
                        <img src="img/foxinban.jpg" class="card-img-top" style="height: 250px; object-fit: cover; object-position: center;" alt="">
                        <div class="post-preview">
                            <a href="post.html">
                                <h2 class="post-title">
                                    Man must explore, and this is exploration at its greatest
                                </h2>
                                <h3 class="post-subtitle">
                                    Problems look mighty small from 150 miles up
                                </h3>
                            </a>
                            <p class="post-meta">Posted by
                                <a href="#">Start Bootstrap</a>
                                on September 24, 2019</p>
                        </div>
                </div>
                <div class="card-post my-3">
                        <img src="" class="img-fluid" alt="">
                        <div class="post-preview">
                            <a href="post.html">
                                <h2 class="post-title">
                                    Man must explore, and this is exploration at its greatest
                                </h2>
                                <h3 class="post-subtitle">
                                    Problems look mighty small from 150 miles up
                                </h3>
                            </a>
                            <p class="post-meta">Posted by
                                <a href="#">Start Bootstrap</a>
                                on September 24, 2019</p>
                        </div>
                </div>
                <div class="card-post my-3">
                        <img src="img/img1.png" class="img-fluid" alt="">
                        <div class="post-preview">
                            <a href="post.html">
                                <h2 class="post-title">
                                    Man must explore, and this is exploration at its greatest
                                </h2>
                                <h3 class="post-subtitle">
                                    Problems look mighty small from 150 miles up
                                </h3>
                            </a>
                            <p class="post-meta">Posted by
                                <a href="#">Start Bootstrap</a>
                                on September 24, 2019</p>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4">
                <div class="card my-3">
                    <h3 class="post-title">Recent Posts</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="#">Laravel aadaldhaf seuiahfad ffodpfabefe ... read more</a>
                            <h1 class="text-comment">Ikhsan Heriyawan - 19-03-2000</h1>
                        </li>
                        <li class="list-group-item">
                            <a href="#">Laravel aadaldhaf seuiahfad ffodpfabefe ... read more</a>
                            <h1 class="text-comment">Ikhsan Heriyawan - 19-03-2000</h1>
                        </li>
                        <li class="list-group-item">
                            <a href="#">Laravel aadaldhaf seuiahfad ffodpfabefe ... read more</a>
                            <h1 class="text-comment">Ikhsan Heriyawan - 19-03-2000</h1>
                        </li>
                    </ul>
            </div>
                <div class="card my-3">
                        <h3 class="post-title">Category</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="">Laravel</a></li>
                            <li class="list-group-item">PHP</li>
                            <li class="list-group-item">JavScriipt</li>
                        </ul>
                </div>
            </div>
        </div>
        <!-- Pager -->
        <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
    </div>
@endsection
