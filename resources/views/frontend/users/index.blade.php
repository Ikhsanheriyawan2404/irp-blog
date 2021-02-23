@extends('layouts.frontend', compact('title'))

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url()">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>My Profil</h1>
                        <span class="subheading">Ikhsan Heriyawan</span>
                        <a href="crud-post.html" class="btn btn-success btn-lg mt-3">Create a Post</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card my-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="img/foxinban.jpg" class="img-thumbnail rounded-circle" alt="">
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius eaque culpa beatae! Optio corporis fugit, aperiam dignissimos! Illum placeat, velit blanditiis deserunt ab facilis officia, atque in harum earum natus.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card my-3">
                    <div class="card-header">
                        <a href="edit-profil.html" class="btn btn-dark float-right"><i class="fas fa-cogs"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Name</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                Ikhsan Heriyawan
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Jenis Kelamin</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                Laki-Laki
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Umur</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                19 Tahun
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Email</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                ikhsanheriyawan2404@gmail.com
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Daftar</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                Ikhsan Heriyawan
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Like</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                <h6>Like</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>Coment</h6>
                            </div>
                            <div class="col-sm-9 text-comment">
                                <h6>Like</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card my-3">
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
                                on September 24, 2019
                                <a class="btn btn-success btn-sm" style="color: white;">Edit <i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-danger btn-sm" style="color: white;">Delete <i class="fas fa-trash"></i></a>
                        </p>
                        </div>
                </div>
                <div class="card my-3">
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
                                on September 24, 2019
                                <a class="btn btn-success btn-sm" style="color: white;">Edit <i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-danger btn-sm" style="color: white;">Delete <i class="fas fa-trash"></i></a>
                        </p>

                        </div>
                </div>
                <div class="float-right">
                    <a class="btn btn-success">Edit <i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger">Delete <i class="fas fa-trash"></i></a>
                    <a class="btn btn-primary">Delete <i class="fas fa-trash"></i></a>
                    <a class="btn btn-info">Delete <i class="fas fa-trash"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
