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
                    <label for="film" class="form-label">Nama Film</label>
                    <select class="form-control" id="film" name="nama_film">
                        <option value="" selected>--Pilih Film--</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
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
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="jumlah" class="form-label">Jumlah Tiket</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Tiket" min="1" max="5" onchange="checkTicketQuantity()">
                    <div id="ticketQuantityWarning" style="display: none; color: red;">Pesan peringatan</div>
                </div>
            </div>

            <br>
            <div class="row justify-content-between">
                <div class="form-group col-md-6">
                    <label for="studio" class="form-label">Jenis Studio</label>
                    <select class="form-control" id="studio" name="jenis_studio">
                        <option value="" selected>--Pilih Jenis Studio--</option>
                        
                    </select>
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
                
                <br>
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
        
                createSeats(leftSection, 30, 'a');
                createSeats(rightSection, 30, 'b');
            </script>           


            <br>
            <p>Keterangan :   <span class="status-box terisi"></span> Terisi | <span class="status-box kosong"></span> Kosong</p>
            
            <br>
            <button type="submit" class="btn btn-primary">Continue</button>
        </form>
    </div>
@endsection