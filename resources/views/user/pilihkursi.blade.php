@extends('layouts.app')

@section('content')
<!-- Modal Pembayaran 1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Metode Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="submitForm" action="{{ route('proses_pembayaran') }}" method="post">
                @csrf
                <div class="form-group" style="margin-bottom: 10px">
                    <label for="nama" class="form-label" style="width: 100px;">Nama </label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                </div>
                <div class="form-group" style="margin-bottom: 10px">
                    <label for="tiket" class="form-label" style="width: 100px;">Tiket</label>
                    <select class="form-control" name="tiket" id="tiket" style="float: right; margin-left: 10px;" onchange="updateTicketPrice()">
                        @foreach ($tikets as $tiket)
                            <option value="{{ $tiket->harga }}">{{ $tiket->tiket }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 10px">
                    <label for="noHp" class="form-label" style="width: 100px;">No. HP </label>
                    <input type="number" class="form-control" id="noHp" name="noHp" placeholder="Masukkan Nomor HP">
                </div>
                <div class="form-group">
                    <label for="total" class="form-label" style="width: 100px;">Total Harga </label>
                    <input type="text" class="form-control" id="total" name="uang" value="Rp. {{ number_format($hargaTiket, 0, ',', '.') }}" disabled>
                </div>
                <script>
                    function setupEventListeners() {
                        const checkboxes = document.querySelectorAll('input[name="metodePembayaran"]');
                        const switchButton = document.getElementById('flexSwitchCheckDefault');
                        const bankInput = document.getElementById('inputBank').querySelector('input');
                        const ewalletInput = document.getElementById('inputEwallet').querySelector('input');

                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', toggleInput);
                        });

                        switchButton.addEventListener('change', toggleButtonState);
                        bankInput.addEventListener('input', toggleButtonState);
                        ewalletInput.addEventListener('input', toggleButtonState);
                    }

                    function toggleInput() {
                        const bankChecked = document.getElementById('radioBRI').checked || document.getElementById('radioBTN').checked;
                        const ewalletChecked = document.getElementById('gopay').checked;
                        const bankInputDiv = document.getElementById('inputBank');
                        const ewalletInputDiv = document.getElementById('inputEwallet');

                        if (bankChecked) {
                            bankInputDiv.style.display = 'block';
                            ewalletInputDiv.style.display = 'none';
                        } else if (ewalletChecked) {
                            bankInputDiv.style.display = 'none';
                            ewalletInputDiv.style.display = 'block';
                        } else {
                            bankInputDiv.style.display = 'none';
                            ewalletInputDiv.style.display = 'none';
                        }

                        toggleButtonState();
                    }
                </script>
                <br>
                <p style="font-weight: bold; text-decoration : underline; padding-bottom: 10px;">Pilih Metode Pembayaran</p>
                <div class="form-group">
                    <!-- Bank -->
                    <p style="font-weight:bold">BANK</p>
                    <table>
                        <tr>
                            <td style="padding: 10px">
                                <input class="form-check-input" type="checkbox" id="radioBRI" name="metodePembayaran" value="BRI">
                                <label for="radioBRI">
                                    <img src="{{ asset('assets/img/bri.jpg') }}" alt="" height="70px" width="90px">
                                </label>
                            </td>
                            <td style="padding: 10px">
                                <input class="form-check-input" type="checkbox" id="radioBTN" name="metodePembayaran" value="BTN">
                                <label for="radioBTN">
                                    <img src="{{ asset('assets/img/b.png') }}" alt="" height="70px" width="90px">
                                </label>
                            </td>
                        </tr>
                    </table>
                    <!-- ewallet -->
                    <p style="font-weight:bold">E-WALLET</p>
                    <table>
                        <tr>
                            <td style="padding: 10px">
                                <input class="form-check-input" type="checkbox" id="gopay" name="metodePembayaran" value="gopay">
                                <label for="gopay">
                                    <img src="{{ asset('assets/img/gopay.png') }}" alt="" height="70px" width="70px">
                                </label>
                            </td>
                        </tr>
                    </table>
                    <!-- inputbank -->
                    <div id="inputBank" style="display: none;">
                        <label for="" style="margin-top: 10px; margin-bottom: 10px">Masukkan Nomor Rekening Bank</label>
                        <input type="number" class="form-control" id="namaBank" placeholder="Masukkan Nomor">
                    </div>
                    <!-- inputewallet -->
                    <div id="inputEwallet" style="display: none;">
                        <label for="" style="margin-top: 10px; margin-bottom: 10px">Masukkan</label>
                        <input type="number" class="form-control" id="namaEwallet" placeholder="Masukkan Nomor">
                    </div>
                </div>
                <div class="form-check form-switch mt-5">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Bayar Nanti Saja</label>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary disabled" id="submitButton" data-bs-toggle="modal">Bayar</button>
                    <button type="button" class="btn btn-primary d-none disabled" id="saveButton">Simpan</button>
                </div>
            </form>
      </div>
    </div>
  </div>
<!-- End -->
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
    <form action="/pesan" method="POST">
        @csrf
        <!-- Film -->
        <div class="col-md-6" style="margin-top: 30px; margin-bottom:20px;">
            <label for="film" style="display: inline-block; width: 100px;">Judul Film </label>
            <span style="margin-left: 10px">: {{ $film->judul }}</span>
        </div>
        <!-- Tiket -->
        <div class="col-md-4" style="margin-top: 30px; margin-bottom: 20px;">
            <label for="tiket" style="float: left; margin-right: 10px; margin-top: 5px;">Pilihan Tiket :</label>
            <div style="overflow: hidden;">
                <select class="form-control" name="tiket" id="tiket" style="float: right; margin-left: 10px;" onchange="updateTicketPrice()">
                    @foreach ($tikets as $tiket)
                        <option value="{{ $tiket->harga }}">{{ $tiket->tiket }}</option>
                    @endforeach
                </select>
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
            <span style="margin-left: 10px">:
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
            </span>
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

            function updateTicketPrice() {
                const ticketPriceElement = document.getElementById('ticketPrice');
                const selectedTicketPrice = document.getElementById('tiket').value;
                ticketPriceElement.textContent = `: ${selectedTicketPrice}`;
            }
        </script>

        <!-- JUMLAH TIKET -->
        <div style="margin-top: 30px; margin-bottom:20px;">
            <label for="jumlah">Jumlah Tiket :</label>
            <span style="margin-left: 10px" id="jumlahTiket">* 1 Kursi = 1 Tiket {{ $jumlahTiket }}</span>
        </div>
        <div style="margin-top: 30px; margin-bottom:20px;">
            <label for="jumlah">Harga Tiket </label>
            <span style="margin-left: 10px" id="ticketPrice">: {{ $tikets[0]->harga }}</span>
        </div>
    </form>
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
                    document.getElementById('jumlahTiket').innerText = jumlahTiket > 0 ? jumlahTiket : '* 1 Kursi = 1 Tiket';
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
                    document.getElementById('totalHarga').innerText = "Rp " + totalHarga.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 2 }).replace(/\.00$/, '');
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
        <button type="button" id="pesanTiketButton" class="btn btn-primary">Konfirmasi Pembayaran</button>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            function toggleInput() {
                var inputBank = document.getElementById("inputBank");
                var inputEwallet = document.getElementById("inputEwallet");
                var bankChecked = document.getElementById("radioBRI").checked || document.getElementById("radioBTN").checked;
                var ewalletChecked = document.getElementById("gopay").checked;

                inputBank.style.display = bankChecked ? "block" : "none";
                inputEwallet.style.display = ewalletChecked ? "block" : "none";
                toggleButtonState();
            }

            function toggleButtonState() {
                var switchChecked = document.getElementById("flexSwitchCheckDefault").checked;
                var submitButton = document.getElementById("submitButton");
                var saveButton = document.getElementById("saveButton");

                if (switchChecked) {
                    submitButton.classList.add('d-none');
                    submitButton.classList.add('disabled');
                    saveButton.classList.remove('d-none');
                    saveButton.classList.remove('disabled');
                } else {
                    saveButton.classList.add('d-none');
                    saveButton.classList.add('disabled');
                    submitButton.classList.remove('d-none');
                    submitButton.classList.remove('disabled');
                }
            }

            document.getElementById("flexSwitchCheckDefault").addEventListener('change', toggleButtonState);
            document.querySelectorAll('input[name="metodePembayaran"]').forEach((input) => {
                input.addEventListener('change', toggleInput);
            });

            toggleButtonState();
        });
    </script>
@endsection
