@extends('layouts.app')

@section('content')
<!-- Modal Pembayaran 1 -->
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
    <a href="/detail/{{ $film->id }}" class="btn btn-transparent">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <br>
    <br>
    <form action="{{ route('pembayaran.store') }}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <!-- Film -->
            <div class="col-md-4" style="margin-top: 30px; margin-bottom:20px;">
                <label for="judul" class="form-label">Judul Film :</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $film->judul }}" disabled>
                <input type="hidden" name="judul" value="{{ $film->judul }}">
            </div>
            <!-- Tiket -->
            <div class="col-md-4" style="margin-top: 30px; margin-bottom: 20px;">
                <label for="tiket" class="form-label">Tiket :</label>
                <div style="overflow: hidden;">
                    <select class="form-control" name="tiket" id="tiket" style="float: right; margin-left: 10px;" onchange="updateTotalHarga()">
                        <option value="0" selected>-- Pilih Tiket --</option>
                        @foreach ($tikets as $tiket)
                            <option value="{{ $tiket->harga }}">{{ $tiket->tiket }}</option>
                        @endforeach 
                    </select>
                </div>
            </div>
            <!-- JUMLAH TIKET -->
            <div class="col-md-4" style="margin-top: 30px; margin-bottom:20px;">
                <label for="jumlahTiket" class="form-label">Jumlah Tiket :</label>
                <input type="text" class="form-control" id="jumlahTiket" value="{{ $jumlahTiket }}" disabled>
                <input type="hidden" name="jumlahTiket" id="hiddenJumlahTiket" value="{{ $jumlahTiket }}">
            </div>
        </div>

        <!-- JAM -->
        @php
            $sortedJam = $tanggal->sortBy(function ($item) {
                return (int) substr($item->jam, 0, 2);
            });
        @endphp

        <div style="margin-top: 30px; margin-bottom:20px;">
            <label for="jam" style="display: inline-block; width: 100px;">Jam </label>
            @if ($sortedJam->isEmpty())
                <span>Tidak ada jadwal jam tayang untuk film ini</span>
            @else
                @foreach ($sortedJam as $t)
                    <div class="form-check form-check-inline" style="display: inline-block; margin-right: 10px;">
                        <label class="form-check-label" for="jam-{{ $loop->index }}">
                            <input class="form-check-input" type="checkbox" id="jam-{{ $loop->index }}" name="jam" value="{{ $t->jam }}" onclick="handleCheckboxChange(this)">
                            {{ substr($t->jam, 0, -3) }}
                        </label>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- JavaScript Jam -->
        <!-- End -->
        <div class="row">
            <div class="col-md-4" style="margin-top: 30px; margin-bottom:20px;">
                <label for="total" class="form-label" style="width: 100px;">Total Harga </label>
                <input type="text" class="form-control" id="total" value="Rp. {{ number_format($totalHarga,0, ',', '.') }}" disabled>
                <input type="hidden" name="total_harga" id="hiddenTotalHarga" value="{{ $totalHarga }}">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="kursi" class="form-label">Pilih Kursi :</label>
            <div class="cinema">
                <style>
                    .cinema {
                        display: flex;
                        justify-content: center;
                        margin-top: 20px;
                    }
                    
                    .cinema .section {
                        display: grid;
                        grid-template-columns: repeat(5, 70px);
                        gap: 10px;
                        margin: 0 20px;
                    }
                    
                    .seat {
                        width: 40px;
                        height: 40px;
                        border-radius: 5px;
                        background-color: gray;
                        text-align: center;
                        line-height: 40px;
                        cursor: pointer;
                        color: white;
                    }

                    .seat.booked {
                        background-color: blue;
                    }

                    .status-box {
                        display: inline-block;
                        width: 15px; /* Lebar kotak */
                        height: 15px; /* Tinggi kotak */
                        margin-right: 5px; /* Jarak antara kotak dan teks */
                        vertical-align: middle; /* Menyelaraskan kotak ke tengah vertikal dengan teks */
                    }

                    .terisi {
                        background-color: green; /* Warna untuk status terisi */
                    }

                    .booking {
                        background-color: red !important; /* Warna untuk status kosong */
                    }

                    .kosong {
                        background-color: grey;
                    }

                    .dipilih {
                        background-color: blue;
                    }
                    </style>
                <div class="section" id="left-section">
                    <!-- Kursi kiri -->
                </div>
                <div class="section" id="right-section">
                    <!-- Kursi kanan -->
                </div>
            </div>

            <!-- Tambahkan screen di bawah kursi -->
            <div style="text-align: center; margin-top: 50px;">
                <div style="background-color: black; color: white; padding: 10px 20px;">LAYAR BIOSKOP</div>
            </div>
            <br>
            <p>Keterangan : <span class="status-box terisi"></span> Terisi | <span class="status-box booking"></span> Booking | <span class="status-box kosong"></span> Kosong | <span class="status-box dipilih"></span> Dipilih </p>
            <br>
            <div class="row">
                <div class="form-group col-md-4" style="margin-bottom: 30px">
                    <label for="nomorKursi" class="form-label">Nomor Kursi :</label>
                    <input type="text" class="form-control" id="nomorKursi" readonly>
                    <input type="hidden" id="hiddenNomorKursi" name="nomor_kursi" value="">
                </div>
            </div>
            <a href="/detail/{{ $film['id'] }}" type="button" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
        </div>
        <script>
            function handleCheckboxChange(checkbox) {
                const checkboxes = document.getElementsByName('jam');

                // Nonaktifkan semua checkbox kecuali yang saat ini diklik
                checkboxes.forEach(function(cb) {
                    if (cb !== checkbox) {
                        cb.checked = false;
                    }
                });
            }

            function updateTotalHarga() {
                const selectedTicketPrice = parseInt(document.getElementById('tiket').value, 10);
                const bookedSeats = document.querySelectorAll('.seat.booked');
                const jumlahTiket = bookedSeats.length;

                const totalHarga = jumlahTiket * selectedTicketPrice;

                document.getElementById('total').value = "Rp. " + totalHarga.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 2 }).replace(/\.00$/, '');
                document.getElementById('hiddenTotalHarga').value = totalHarga;
                document.getElementById('jumlahTiket').value = jumlahTiket > 0 ? jumlahTiket : '0';
                document.getElementById('hiddenJumlahTiket').value = jumlahTiket > 0 ? jumlahTiket : '0';
            }

            function createSeats(section, seatCount, label) {
                for (let i = 0; i < seatCount; i++) {
                    const seat = document.createElement('div');
                    seat.classList.add('seat');
                    const nomorKursi = i + 1;
                    seat.innerText = nomorKursi + label;
                    seat.setAttribute('data-nomor-kursi', nomorKursi); // Tambahkan nomor kursi ke atribut data

                    seat.addEventListener('click', function() {
                        if (!seat.classList.contains('booked')) {
                            seat.classList.add('booked');
                        } else {
                            seat.classList.remove('booked');
                        }

                        updateJumlahTiket();
                        updateTotalHarga();
                        updateNomorKursi(); // Panggil fungsi untuk mengupdate nomor kursi yang dipilih
                    });

                    section.appendChild(seat);
                }
            }

            function updateNomorKursi() {
                const selectedSeats = document.querySelectorAll('.seat.booked');
                const nomorKursiArray = [];

                selectedSeats.forEach(function(seat) {
                    const nomorKursi = seat.getAttribute('data-nomor-kursi'); 
                    const label = seat.innerText.slice(-1); 
                    const nomorKursiWithLabel = nomorKursi + label; 
                    nomorKursiArray.push(nomorKursiWithLabel); 
                });

                document.getElementById('nomorKursi').value = nomorKursiArray.join(', '); // Simpan nomor kursi dalam format string dipisahkan koma
                document.getElementById('hiddenNomorKursi').value = nomorKursiArray.join(', '); // Simpan nomor kursi dalam format string dipisahkan koma
            }

            function updateJumlahTiket() {
                const bookedSeats = document.querySelectorAll('.seat.booked');
                const jumlahTiket = bookedSeats.length;

                document.getElementById('jumlahTiket').value = jumlahTiket > 0 ? jumlahTiket : '0';
                document.getElementById('hiddenJumlahTiket').value = jumlahTiket > 0 ? jumlahTiket : '0';
            }

            const leftSection = document.getElementById('left-section');
            const rightSection = document.getElementById('right-section');

            createSeats(leftSection, {{ $kursi->kursi }}, 'a');
            createSeats(rightSection, {{ $kursi->kursi }}, 'b');

            updateTotalHarga();
            updateJumlahTiket();
        </script>
    </form>
@endsection