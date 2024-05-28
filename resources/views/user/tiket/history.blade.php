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

            /* Tambahkan gaya untuk teks putih di dalam tabel */
            .table th,
            .table td {
                color: white;
            }
        </style>
        <a href="/" class="btn btn-transparent">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <h3 style="margin-top: 30px">History Pemesanan</h3>
        @if ($pembayaran->isEmpty())
            <div class="d-flex flex-column justify-content-center align-items-center" style="height: 60vh; margin-top: 30px;">
                <i class="bi bi-clock" style="font-size: 3rem;"></i>
                <p class="center-text">History pesanan Anda akan muncul di sini.</p>
            </div>
        @else
        <div class="table-responsive" style="margin-top: 30px">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tiket</th>
                        <th>Jam</th>
                        <th>Jumlah Tiket</th>
                        <th>Nomor Kursi</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $p)
                    <tr>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->tiket }}</td>
                        <td>
                            <?php
                            $formatted_time = date('H:i', strtotime($p->jam));
                            ?>
                            {{ $formatted_time }}
                        </td>
                        <td>{{ $p->jumlah_tiket }}</td>
                        <td>{{ $p->nomor_kursi }}</td>
                        <td>{{ $p->total_harga }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
@endsection