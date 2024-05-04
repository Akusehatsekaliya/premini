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
            <form action="">
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
                </div>
                <br>
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="nama" placeholder="Masukkan Email">
                </div>
            </form>
            <br>
            <p style="font-weight: bold; text-decoration : underline; padding-bottom: 10px;">Pilih Metode Pembayaran</p>
        <div class="form-group">
            <p style="font-weight:bold ">BRIVA</p>
            <table>
                <tr>
                    <td style="padding: 10px">
                        <input class="form-check-input" type="radio" id="radioBRI" name="metodePembayaran" value="BRI">
                        <label for="radioBRI">
                            <img src="{{ asset('assets/img/bri.jpg') }}" alt="" height="70px" height="70px">
                        </label>
                    </td>
                    <td style="padding: 10px">
                        <input class="form-check-input" type="radio" id="radioR" name="metodePembayaran" value="R">
                        <label for="radioR">
                            <img src="{{ asset('assets/img/R.png') }}" alt="" height="70px" height="70px">
                        </label>
                    </td>
                    <td style="padding: 10px">
                        <input class="form-check-input" type="radio" id="radioMan" name="metodePembayaran" value="Man">
                        <label for="radioMan">
                            <img src="{{ asset('assets/img/man.png') }}" alt="" height="70px" height="70px">
                        </label>
                    </td>                    
                </tr>
            </table>
            <p style="font-weight:bold ">E WALET</p>
            <table>
                <tr>
                    <td style="padding: 25px">
                        <img src="{{ asset('assets/img/q.png') }}" alt="" height="30px" height="30px">
                    </td>
                    <td style="padding: 20px"><img src="{{ asset('assets/img/ovo.jpeg') }}" alt="" height="70px" height="70px"></td>
                    <td style="padding: 20px"><img src="{{ asset('assets/img/s.png') }}" alt="" height="50px" height="50px    "></td>
                </tr>
            </table>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onchange="toggleRadio()">
                <label class="form-check-label" for="flexSwitchCheckDefault">Bayar Nanti Saja</label>
            </div>
            <script>
                function toggleRadio() {
                    var switchButton = document.getElementById("flexSwitchCheckDefault");
                    var radioBRI = document.getElementById("radioBRI");
                    var radioR = document.getElementById("radioR");
                    var radioMan = document.getElementById("radioMan");
                
                    // Jika switch dinyalakan (checked), matikan radio button
                    if (switchButton.checked) {
                        radioBRI.disabled = true;
                        radioR.disabled = true;
                        radioMan.disabled = true;
                    } else { // Jika switch dimatikan (unchecked), aktifkan kembali radio button
                        radioBRI.disabled = false;
                        radioR.disabled = false;
                        radioMan.disabled = false;
                    }
                }
            </script>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary">Lanjut</button>
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
            <i class="bi bi-arrow-left"></i> Kembali
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
                             <option value="" selected>--Pilih Film--</option>
                            @foreach ($film as $f)
                                 <option value="{{ $f->id }}">{{ $f->judul }}</option>
                             @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6 mt-6">
                    <label for="nama" class="form-label">Atur Tanggal</label>
                    <?php
                    $today = date('Y-m-d'); 
                    $formatted_date = date('l, j F Y', strtotime($today));
                    ?>
                    <input type="text" class="form-control" id="tanggal" value="<?php echo $formatted_date; ?>" disabled>
                </div>                            
            </div>
            <br>
            <div class="row justify-content-between">
                <div class="form-group col-md-6">
                    <label for="jam" class="form-label">Jam Tayang</label>
                    <select class="form-control" id="jam" name="jam_tayang">
                        @foreach ($tanggal as $t)
                            <option value="{{ $t->id }}">{{ $t->jam }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="tiket" class="form-label"> Tiket Tersedia</label>
                        @foreach ($tiket as $t)
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
                    <label for="jumlah" class="form-label">Jumlah Tiket</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Tiket" min="1" max="5" onchange="checkTicketQuantity()">
                    <div id="ticketQuantityWarning" style="display: none; color: red;">Pesan peringatan</div>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js" integrity="sha512-bE0ncA3DKWmKaF3w5hQjCq7ErHFiPdH2IGjXRyXXZSOokbimtUuufhgeDPeQPs51AI4XsqDZUK7qvrPZ5xboZg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

                <script>
                    function checkTicketQuantity() {
                        var jumlahInput = document.getElementById('jumlah');
                        var ticketQuantityWarning = document.getElementById('ticketQuantityWarning');
                        
                        // Mendapatkan stok tiket dari suatu sumber data, misalnya dari variabel PHP
                        var stokTiket = <?php echo $t->stok; ?>; 

                        var minPembelian = 1;

                        if (jumlahInput.value < minPembelian) {
                            jumlahInput.value = minPembelian; // Jika jumlah input kurang dari minimal pembelian, atur nilai input menjadi minimal pembelian
                            ticketQuantityWarning.innerText = 'Minimal pembelian tiket adalah ' + minPembelian; // Set pesan peringatan
                            ticketQuantityWarning.style.display = 'block'; // Tampilkan pesan peringatan
                        } else if (jumlahInput.value > stokTiket) {
                            jumlahInput.value = stokTiket; // Jika jumlah input melebihi stok tiket, atur nilai input menjadi stok tiket
                            ticketQuantityWarning.innerText = 'Maksimal pembelian tiket adalah ' + stokTiket; // Set pesan peringatan
                            ticketQuantityWarning.style.display = 'block'; // Tampilkan pesan peringatan
                        } else {
                            ticketQuantityWarning.style.display = 'none'; // Sembunyikan pesan peringatan jika jumlah input valid
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
                // Fungsi untuk membuat kursi bioskop
                function createSeats(section, seatCount, label) {
                    for (let i = 0; i < seatCount; i++) {
                        const seat = document.createElement('div');
                        seat.classList.add('seat');
                        seat.innerText = i + 1 + label;

                        // Tambahkan event listener untuk mengubah warna kursi saat kursi dipesan
                        seat.addEventListener('click', function() {
                            if (seat.classList.contains('booked')) {
                                // Jika kursi sudah dipesan, kembalikan ke warna merah
                                seat.classList.remove('booked');
                            } else {
                                // Jika kursi belum dipesan, tandai sebagai dipesan (berwarna hijau)
                                seat.classList.add('booked');
                            }
                        });

                        // Tambahkan event listener untuk double click
                        seat.addEventListener('dblclick', function() {
                            seat.classList.toggle('booked'); // Toggle status booked saat double click
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
            <p>Keterangan :   <span class="status-box terisi"></span> Terisi | <span class="status-box booking"></span> Booking | <span class="status-box kosong"></span> Kosong | <span class="status-box dipilih"></span> Dipilih </p>

            <br>
        </form>
        <div data-bs-toggle="modal" data-bs-target="#exampleModal">
            <button type="button" class="btn btn-primary">Continue</button>
        </div>

    </div>
@endsection
