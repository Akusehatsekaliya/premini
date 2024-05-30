@extends('admin.main')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bukti Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Tiket</th>
                                <th>Total Harga</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @forelse ($pembayaran as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->user->name }}</td>
                                    <td>{{ $p->judul }}</td>
                                    <td>{{ $p->tiket }}</td>
                                    <td>
                                        <?php
                                        $formatted_price = 'Rp ' . number_format($p->total_harga, 0, ',', '.');
                                        ?>
                                        {{ $formatted_price }}
                                    </td>
                                    <td>
                                        @if($p->bukti)
                                        <a href="{{ asset('storage/bukti/' . $p->bukti) }}" data-lightbox="image-{{ $p->id }}" data-title="Bukti Pembayaran">
                                            <img src="{{ asset('storage/bukti/' . $p->bukti) }}" alt="Bukti Pembayaran" style="max-width: 100px;">
                                        </a>
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($p->status === 'Pending')
                                            <form action="{{ route('adminadmin.verifikasi', $p->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" name="verifikasi" class="btn btn-success">Terima</button>
                                                <button type="submit" name="tolak" class="btn btn-danger">Tolak</button>
                                            </form>
                                        @elseif($p->status === 'Diterima')
                                            <button type="button" class="btn btn-success" readonly>Diterima</button>
                                        @elseif($p->status === 'Ditolak')
                                            <button type="button" class="btn btn-danger" readonly>Ditolak</button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="text-align:center;">Data masih kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
