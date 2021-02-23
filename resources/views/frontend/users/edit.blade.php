@extends('layouts.frontend', compact('title'))

@section('custom-styles')
    <style>
    @media only screen and (min-width: 768px) {
        header.masthead .page-heading,
        header.masthead .post-heading,
        header.masthead .site-heading {
            padding: 50px 0;
        }
    }

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
                    <div class="form-group">
                        <label for="name">Name <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image <small class="text-secondary">tidak wajib diisi, jika tidak diganti</small></label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio <small class="text-secondary">*</small></label>
                        <textarea type="text" class="form-control" name="bio" id="bio"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin <small class="text-danger">*</small></label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Tanggal Lahir <small class="text-danger">*</small></label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') ?? $user->date_of_birth }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password <small class="text-secondary">tidak wajib diisi</small></label>
                        <input type="text" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password <small class="text-secondary">hanya untuk ganti kata sandi</small></label>
                        <input type="text" class="form-control" name="confirm_password" id="confirm_password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
