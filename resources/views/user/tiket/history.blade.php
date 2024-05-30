@extends('layouts.app')

@section('content')
<br><br>
<div class="container">
    <style>
        .btn-transparent {
            background-color: transparent;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-transparent:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .table th,
        .table td {
            color: white;
            text-align: center;
        }

        .modal-content {
            background-color: white; /* White background for modal */
            color: black; /* Black text color for modal */
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
    <div class="table table-hover" style="margin-top: 30px">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Film</th>
                    <th>Tiket</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $key => $p)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $p->judul }}</td>
                    <td>{{ $p->tiket }}</td>
                    <td>
                        <?php
                        $formatted_price = 'Rp ' . number_format($p->total_harga, 0, ',', '.');
                        ?>
                        {{ $formatted_price }}
                    </td>
                    <td>
                        @if($p->status === 'Pending')
                        <button type="button" class="btn btn-dark btn-sm" readonly>{{ $p->status }}</button>
                        @elseif($p->status === 'Diterima')
                        <button type="button" class="btn btn-success btn-sm" readonly>{{ $p->status }}</button>
                        @elseif($p->status === 'Ditolak')
                        <button type="button" class="btn btn-danger btn-sm" readonly>{{ $p->status }}</button>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $p->id }}">
                            Detail
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="detailModal-{{ $p->id }}" tabindex="-1" aria-labelledby="detailModalLabel-{{ $p->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: white">
                                <h5 class="modal-title" id="detailModalLabel-{{ $p->id }}">Detail Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: white">
                                <p><strong>Judul:</strong> {{ $p->judul }}</p>
                                <p><strong>Tiket:</strong> {{ $p->tiket }}</p>
                                <p><strong>Jam:</strong>
                                    <?php
                                    $formatted_time = date('H:i', strtotime($p->jam));
                                    ?>
                                    {{ $formatted_time }}
                                </p>
                                <p><strong>Jumlah Tiket:</strong> {{ $p->jumlah_tiket }}</p>
                                <p><strong>Nomor Kursi:</strong> {{ $p->nomor_kursi }}</p>
                                <p><strong>Total Harga:</strong> {{ $formatted_price }}</p>
                                <p><strong>Status:</strong> 
                                    @if($p->status === 'Pending')
                                    <button type="button" class="btn btn-dark btn-sm" readonly>{{ $p->status }}</button>
                                    @elseif($p->status === 'Diterima')
                                    <button type="button" class="btn btn-success btn-sm" readonly>{{ $p->status }}</button>
                                    @elseif($p->status === 'Ditolak')
                                    <button type="button" class="btn btn-danger btn-sm" readonly>{{ $p->status }}</button>
                                    @endif
                                </p>
                                <p><strong>Bukti Pembayaran:</strong></p>
                                @if($p->bukti)
                                <img src="{{ asset('storage/bukti/' . $p->bukti) }}" alt="Bukti Pembayaran" style="max-width: 100%;">
                                @else
                                N/A
                                @endif
                            </div>
                            <div class="modal-footer" style="background-color: white">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
