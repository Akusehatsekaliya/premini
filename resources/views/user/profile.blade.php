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

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <br>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name" class="col-sm-2 col-form-label">Nama </label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}">
            </div>
            <div class="form-group col-md-6">
                <label for="email" class="col-sm-2 col-form-label">Email </label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}">
            </div>
        </div>

        <br>
        <div class="form-group col-md-6">
            <label for="password" class="col-sm-2 col-form-label">Password </label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="see_pass"><i class="fa fa-eye"></i></button>
                </span>
            </div>
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

        <br>
        <div class="form-group col-md-6">
            <label for="saldo" class="col-sm-2 col-form-label">Saldo </label>
            <div class="input-group">
                <span class="input-group-text">Rp.</span>
                @php
                    $formatted_saldo = number_format(Auth::user()->saldo, 0, ',', '.');
                @endphp

                <input type="number" class="form-control" id="saldo" name="saldo" value="{{ old('saldo', $formatted_saldo) }}">
            </div>
        </div>

        <br>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Simpan Profile</button>
            </div>
        </div>
    </form>
</div>
@endsection
