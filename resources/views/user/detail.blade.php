@extends('layouts.app')

@section('content')

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
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <br>
        <br>
        <h1 style="margin-bottom: 50px;">Detail Film</h1>
        <div style="display: flex; align-items: flex-start;">
            <img class="card-img-top" src="{{ asset('storage/vidio/'. $film->film) }}" alt="" style="max-width: 400px; max-height:700px; margin-right: 20px;">
            <div style="display: flex; flex-direction: column;">
                <h2 class="card-title" style="align-self: flex-start; margin-bottom: 50px;">{{ $film->judul }}</h2>
                <p class="card-text" style="margin-bottom: 27px;">{{ $film->detail }}</p>
                <br>
                <a href="{{ route('pesan',['id'=>$film->id]) }}" class="btn btn-primary" style="display: inline-block;">Pesan Tiket</a>
            </div>
        </div>
@endsection
