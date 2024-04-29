@extends('layouts.app')

@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>hay</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary">Bayar</button>
        </div>
      </div>
    </div>
  </div>
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
        <h1>Form Pembelian Tiket</h1>

        <br>
        <form action="/belitiket" method="POST">
            @csrf
            <div class="row justify-content-between">
                <div class="form-group col-md-6">
                    <label for="kursi_id" class="form-label"> Film </label>
                    <select class="form-control" name="kursi_id" id="kursi_id">
                             <option value="">Pilih Film</option>
                            @foreach ($film as $f)
                                 <option value="{{ $f->id }}">{{ $f->judul }}</option>
                             @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6 mt-6">
                    <label for="nama" class="form-label">Atur Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" min="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <br>
            <div class="row justify-content-between">
                <div class="form-group col-md-6">
                    <label for="jam" class="form-label">Jam Tayang</label>
                    <select class="form-control" id="jam" name="jam_tayang">
                        <option value="" selected>--Pilih Jam Tayang--</option>
                        <option value="">20:00</option>
                        <option value="">12:00</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                        @foreach ($tiket as $t)
                            <label for="" class="form-label"> Jumlah Tiket</label>
                            <input type="text" class="form-control" value="{{ $t->stok }}" disabled>
                        @endforeach
                </div>
            </div>

            <br>
            <div class="row justify-content-between">
                <div class="form-group col-md-6">
                    <label for="studio" class="form-label">Jenis Studio</label>
                    <select class="form-control" id="studio" name="jenis_studio">
                        <option value="" selected>--Pilih Jenis Studio--</option>
                       @foreach ($tiket as $s)
                        <option value="{{ $f->id }}">{{ $s->tiket }}</option>
                       @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="jumlah" class="form-label">Tiket</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Tiket" min="1" max="5" onchange="checkTicketQuantity()">
                    <div id="ticketQuantityWarning" style="display: none; color: red;">Pesan peringatan</div>
                </div>
            </div>

                <script>
                    function checkTicketQuantity() {
                        const jumlahInput = document.getElementById('jumlah');
                        const ticketQuantityWarning = document.getElementById('ticketQuantityWarning');
                        const minValue = parseInt(jumlahInput.min);
                        const maxValue = parseInt(jumlahInput.max);

                        if (parseInt(jumlahInput.value) < minValue) {
                            ticketQuantityWarning.innerText = "Minimal pembelian tiket adalah " + minValue;
                            ticketQuantityWarning.style.display = 'block';
                            jumlahInput.value = minValue; // Set nilai input kembali ke nilai minimal
                        } else if (parseInt(jumlahInput.value) > maxValue) {
                            ticketQuantityWarning.innerText = "Maksimal pembelian tiket adalah " + maxValue;
                            ticketQuantityWarning.style.display = 'block';
                            jumlahInput.value = maxValue; // Set nilai input kembali ke nilai maksimal
                        } else {
                            ticketQuantityWarning.style.display = 'none';
                        }
                    }
                </script>

            <br>
            <div class="form-group">
                <label for="kursi" class="form-label">Pilih Kursi Bioskop</label>
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
                            background-color: red;
                            text-align: center;
                            line-height: 40px;
                            cursor: pointer;
                            color: white;
                        }

                        .seat.booked {
                            background-color: green;
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

                        .kosong {
                            background-color: red; /* Warna untuk status kosong */
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
                // Fungsi untuk membuat kursi bioskop
                function createSeats(section, seatCount, label) {
                    for (let i = 0; i < seatCount; i++) {
                        const seat = document.createElement('div');
                        seat.classList.add('seat');
                        seat.innerText = i + 1 + label;

                        // Tambahkan event listener untuk mengubah warna kursi saat kursi dipesan
                        seat.addEventListener('click', function() {
                            if (!seat.classList.contains('booked')) {
                                seat.classList.add('booked');
                            }
                        });

                        section.appendChild(seat);
                    }
                }

                // Membuat 30 kursi di kiri dan 30 kursi di kanan
                const leftSection = document.getElementById('left-section');
                const rightSection = document.getElementById('right-section');
                @foreach ($kursi as $k)
                createSeats(leftSection, {{ $k->kursi }}, 'a');
                createSeats(rightSection, {{ $k->kursi }}, 'b');
                @endforeach
            </script>


            <br>
            <p>Keterangan :   <span class="status-box terisi"></span> Terisi | <span class="status-box kosong"></span> Kosong</p>

            <br>
        </form>
        <div data-bs-toggle="modal" data-bs-target="#exampleModal">
            <button type="button" class="btn btn-primary">continue</button>
        </div>

    </div>
@endsection
