@extends('layouts.frontend', compact('title'))

@section('custom-styles')
    <style>
    header.masthead .page-heading,
    header.masthead .post-heading,
    header.masthead .site-heading {
        padding: 100px 0 50px;
        color: white;
    }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url()">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Edit Profile</h1>
                        <a style="color: white;" href="{{ route('user.show', $user->id) }}">Profil</a> / Edit
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10 mx-auto">
                <div class="card my-3">
                    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ?? $user->name }}" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image <small class="text-secondary">tidak wajib diisi, jika tidak diganti</small></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bio">Bio <small class="text-secondary">maksimal 255 karakter*</small></label>
                            <textarea type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" id="bio">{{ old('bio') ?? $user->bio }}</textarea>
                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin <small class="text-danger">*</small></label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Tanggal Lahir <small class="text-danger">*</small></label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') ?? $user->date_of_birth }}">
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success float-right">Edit <i class="fas fa-pencil-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
