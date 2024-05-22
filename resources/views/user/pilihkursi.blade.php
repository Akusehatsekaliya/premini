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
    <form action="{{ route('pembayaran') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Film -->
            <div class="col-md-4" style="margin-top: 30px; margin-bottom:20px;">
                <label for="film"  class="form-label">Judul Film :</label>
                <input type="text" class="form-control" name="film" value=" {{ $film->judul }}" disabled>
            </div>
            <!-- Tiket -->
            <div class="col-md-4" style="margin-top: 30px; margin-bottom: 20px;">
                <label for="tiket" class="form-label">Tiket :</label>
                <div style="overflow: hidden;">
                    <select class="form-control " name="tiket" id="tiket" style="float: right; margin-left: 10px;" onchange="updateTicketPrice()">
                        <option value="0" selected>-- Pilih Tiket --</option>
                        @foreach ($tikets as $tiket)
                            <option value="{{ $tiket->harga }}">{{ $tiket->tiket }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- JUMLAH TIKET -->
            <div class="col-md-4" style="margin-top: 30px; margin-bottom:20px;">
                <label for="jumlah" class="form-label">Jumlah Tiket :</label>
                <input type="text" class="form-control" id="jumlahTiket" name="jumlahTiket" value="{{ $jumlahTiket }}" disabled>
            </div>
        </div>

        <!-- JAM -->
        @php
            $sortedJam = $tanggal->sortBy(function ($item) {
                return (int) substr($item->jam, 0, 2);
            });
        @endphp

        <div class="col-md-6" style="margin-top: 30px; margin-bottom:20px;">
            <label for="film" style="display: inline-block; width: 100px;">Jam </label>
            @if ($sortedJam->isEmpty())
                <span>Tidak ada jadwal jam tayang untuk film ini</span>
            @else
                @foreach ($sortedJam as $t)
                    <div class="form-check form-check-inline" style="display: inline-block; margin-right: 10px;">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="jam" value="{{ $t->jam }}" onclick="handleCheckboxChange(this)">
                            {{ substr($t->jam, 0, -3) }}
                        </label>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- JavaScript Jam -->
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

            function updateTicketPrice() {
                // Ambil nilai harga tiket yang dipilih
                var selectedTicketPrice = document.getElementById('tiket').value;

                // Set nilai total harga sesuai dengan harga tiket yang dipilih
                document.getElementById('total').value = "Rp. " + selectedTicketPrice.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        </script>
        <!-- End -->
        <div class="col-md-4" style="margin-top: 30px; margin-bottom:20px;">
            <label for="total" class="form-label" style="width: 100px;">Total Harga </label>
            <input type="text" class="form-control" id="total" name="total" value="Rp. {{ number_format($totalHarga,0, ',', '.') }}" disabled>
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

            <script>
                // Fungsi untuk memeriksa apakah ada kursi yang dipilih
                function checkSelectedSeats() {
                    const selectedSeats = document.querySelectorAll('.seat.booked');
                    const pesanTiketButton = document.getElementById('pesanTiketButton');
                    pesanTiketButton.disabled = true;

                    // Menyimpan nomor kursi yang dipilih
                    let nomorKursi = [];

                    // Memperbarui nomor kursi yang dipilih
                    selectedSeats.forEach(function(seat) {
                        nomorKursi.push(seat.innerText);
                    });

                    // Menampilkan nomor kursi pada elemen "Nomor Kursi"
                    document.getElementById('nomorKursi').innerText = nomorKursi.join(', ');

                    // Jika ada kursi yang dipilih, aktifkan tombol Pesan Tiket
                    if (selectedSeats.length > 0) {
                        pesanTiketButton.removeAttribute('disabled');
                        pesanTiketButton.classList.remove('btn-outline-primary');
                        pesanTiketButton.classList.add('btn-primary');
                    } else {
                        // Jika tidak ada kursi yang dipilih, nonaktifkan tombol Pesan Tiket
                        pesanTiketButton.disabled = true;
                        pesanTiketButton.setAttribute('disabled', 'disabled');
                        pesanTiketButton.classList.remove('btn-primary');
                        pesanTiketButton.classList.add('btn-outline-primary');
                    }
                }

                // Fungsi untuk mengatur kursi dan jumlah tiket
                function createSeats(section, seatCount, label) {
                    for (let i = 0; i < seatCount; i++) {
                        const seat = document.createElement('div');
                        seat.classList.add('seat');
                        seat.innerText = i + 1 + label;

                        // Tambahkan event listener untuk mengubah warna kursi saat kursi dipesan
                        seat.addEventListener('click', function() {
                            if (!seat.classList.contains('booked')) {
                                // Jika kursi belum dipesan, tandai sebagai dipesan (berwarna hijau)
                                seat.classList.add('booked');
                            } else {
                                // Jika kursi sudah dipesan, kembalikan ke warna merah
                                seat.classList.remove('booked');
                            }

                            // Perbarui jumlah tiket
                            updateJumlahTiket();
                            // Perbarui total harga
                            updateTotalHarga();
                            // Periksa apakah ada kursi yang dipilih
                            checkSelectedSeats();
                        });

                        section.appendChild(seat);
                    }
                }

                // Fungsi untuk memperbarui tampilan jumlah tiket
                function updateJumlahTiket() {
                    const bookedSeats = document.querySelectorAll('.seat.booked');
                    const jumlahTiket = bookedSeats.length;

                    // Set nilai input jumlah tiket dengan jumlah kursi yang dipilih
                    document.getElementById('jumlahTiket').value = jumlahTiket > 0 ? jumlahTiket : '0';
                }

                // Fungsi untuk memperbarui tampilan total harga tiket
                function updateTotalHarga() {
                    const bookedSeats = document.querySelectorAll('.seat.booked');
                    const jumlahTiket = bookedSeats.length;

                    // Ambil harga tiket dari variabel PHP
                    const hargaTiket = {{ $hargaTiket }};

                    // Hitung total harga tiket
                    const totalHarga = jumlahTiket + hargaTiket;

                    // Simpan total harga tiket ke local storage
                    localStorage.setItem('totalHarga', totalHarga);

                    // Tampilkan total harga tiket dengan format mata uang
                    document.getElementById('totalHarga').value = "Rp " + totalHarga.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 2 }).replace(/\.00$/, '');
                }


                // Membuat 30 kursi di kiri dan 30 kursi di kanan
                const leftSection = document.getElementById('left-section');
                const rightSection = document.getElementById('right-section');

                createSeats(leftSection, {{ $kursi->kursi }}, 'a');
                createSeats(rightSection, {{ $kursi->kursi }}, 'b');


                // Panggil fungsi updateTotalHarga, updateJumlahTiket, dan checkSelectedSeats saat halaman dimuat
                updateTotalHarga();
                updateJumlahTiket();
                checkSelectedSeats();
            </script>
            <!-- Tambahkan screen di bawah kursi -->
            <div style="text-align: center; margin-top: 50px;">
                <div style="background-color: black; color: white; padding: 10px 20px;">LAYAR BIOSKOP</div>
            </div>
    <br>
    <p>Keterangan :   <span class="status-box terisi"></span> Terisi | <span class="status-box booking"></span> Booking | <span class="status-box kosong"></span> Kosong | <span class="status-box dipilih"></span> Dipilih </p>

    <br>
    <div data-bs-toggle="modal" data-bs-target="#exampleModal">
        <a href="/pesan/{{ $film['id'] }}" type="button" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
    </div>
</div>
</form>
@endsection
