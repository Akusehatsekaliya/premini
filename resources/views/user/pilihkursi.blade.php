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
    <a href="/pesan" class="btn btn-transparent">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <br>
    <br>
    <p>Film : {{ $film['judul'] }}</p>
    <p>Studio : {{ $tiket['tiket'] }}</p>
    <p>Tanggal : {{ \Carbon\Carbon::parse($tanggal->tanggal)->isoFormat('D MMMM YYYY'); }}</p>
    <p>Jam: <span id="selectedTime">{{ $tanggal['jam'] }}</span></p>
    <p>Jumlah Tiket : <span id="jumlahTiket">{{ $tiket['stok'] }}  </span></p>
    <p>Total Harga : <span id="totalHarga"></span></p>
    <br>
            <div class="form-group">
                <label for="kursi" class="form-label">Pilih Kursi Bioskop :</label>
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
                            background-color: yellow;
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
                            background-color: yellow;
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
                            
                            // Jika ada kursi yang dipilih, aktifkan tombol Pesan Tiket
                            if (selectedSeats.length > 0) {
                                pesanTiketButton.removeAttribute('disabled');
                                pesanTiketButton.classList.remove('btn-outline-primary');
                                pesanTiketButton.classList.add('btn-primary');
                            } else {
                                // Jika tidak ada kursi yang dipilih, nonaktifkan tombol Pesan Tiket
                                pesanTiketButton.disabled = false;
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
                        const stokTiket = "{{ $tiket->stok }}"; // Ambil nilai stok tiket dari variabel PHP
                        document.getElementById('jumlahTiket').innerText = jumlahTiket > 0 ? jumlahTiket + " / " + stokTiket : '0 / ' + stokTiket;
                    }
                    
                        // Fungsi untuk memperbarui tampilan total harga tiket
                        function updateTotalHarga() {
                            const bookedSeats = document.querySelectorAll('.seat.booked');
                            const jumlahTiket = bookedSeats.length;
                            
                            // Ambil harga tiket dari variabel PHP
                            const hargaTiket = {{ $hargaTiket }};
                            
                            // Hitung total harga tiket
                            const totalHarga = jumlahTiket * hargaTiket;
                            
                            // Tampilkan total harga tiket dengan format mata uang
                            document.getElementById('totalHarga').innerText = "Rp " + totalHarga.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 2 }).replace(/\.00$/, '');
                        }
                        // Format Jam 
                        document.getElementById('selectedTime').innerText = "{{ $tanggal->jam }}".replace(/:\d{2}$/, '');
                        // Membuat 30 kursi di kiri dan 30 kursi di kanan
                        const leftSection = document.getElementById('left-section');
                        const rightSection = document.getElementById('right-section');
                        @foreach ($kursi as $k)
                        createSeats(leftSection, {{ $k->kursi }}, 'a');
                        createSeats(rightSection, {{ $k->kursi }}, 'b');
                        @endforeach
                    
                        // Panggil fungsi updateTotalHarga, updateJumlahTiket, dan checkSelectedSeats saat halaman dimuat
                        updateTotalHarga();
                        updateJumlahTiket();
                        checkSelectedSeats();
                    </script>

            <br>
            <p>Keterangan :   <span class="status-box terisi"></span> Terisi | <span class="status-box booking"></span> Booking | <span class="status-box kosong"></span> Kosong | <span class="status-box dipilih"></span> Dipilih </p>

            <br>
            <a href="/pesan" type="button" class="btn btn-secondary">Cancel</a>
            <a href="/order" type="button" id="pesanTiketButton" class="btn btn-outline-primary" onchange="checkSelectedSeats();" disabled=""> Konfirmasi Pembayaran </a>
            </div>
@endsection