@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<br>
<br>
<div class="container">
    <style>
        .btn-transparent {
            background-color: transparent;
            color: white; /* Warna teks putih */
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .btn-transparent:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Ubah opasitas sesuai kebutuhan */
        }
    </style>
    <a href="/" class="btn btn-transparent">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <br>
        <br>
        <h1>Profil Pengguna</h1>

        <br>
        <form action="/editprofile" method="POST">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama  : </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="name" value="{{ old('name', isset($user) ? $user->name : '') }}">
                </div>
            </div>

            <br>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email  : </label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" value="{{ old('email', isset($user) ? $user->email : '') }}">
                </div>
            </div>

            <br>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password  : </label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" value="{{ old('password', isset($user) ? $user->password : '') }}">     
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="see_pass"><i class="fa fa-eye"></i></button>
                    </span>

                    <script>
                    document.getElementById('see_pass').addEventListener('click', function() {
                        var passwordInput = document.getElementById('password');
                        var icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
                </script>
                </div>
            </div>
        </form>

        <br>
        <br>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" disabled>Simpan</button>
            </div>
        </div>
</div>
@endsection