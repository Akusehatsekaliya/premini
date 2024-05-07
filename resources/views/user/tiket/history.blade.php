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
        @if ($order->isEmpty())
            <div class="d-flex flex-column justify-content-center align-items-center" style="height: 60vh;">
                <i class="bi bi-clock" style="font-size: 3rem;"></i>
                <p class="center-text">History pesanan Anda akan muncul di sini.</p>
            </div>
        @else

        @endif
  

    </div>
@endsection