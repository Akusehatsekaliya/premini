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
                    <label for="" class="form-label">No. HP</label>
                    <input type="number" class="form-control" name="nama" placeholder="Masukkan Nomor HP">
                </div>
                <br>
                <div class="form-group">
                    <label for="total" class="form-label">Total Pesanan</label>
                    <input type="text" class="form-control" id="total" name="total" value="Rp. {{ number_format(0, 0, ',', '.') }}" disabled>
                </div>
                <script>
                    window.onload = function() {
                        const totalHarga = localStorage.getItem('totalHarga');

                        // Tetapkan nilai total harga tiket ke input total
                        document.getElementById('total').value = "Rp " + totalHarga.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 2 }).replace(/\.00$/, '').replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    };
                </script>                
            </form>
            <div class="form-check form-switch mt-5">target
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Bayar Nanti Saja</label>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary" id="submitButton" data-bs-="modal1">Lanjut</button>
                <button type="button" class="btn btn-primary d-none" id="saveButton">Simpan</button>
            </div>
            
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const switchButton = document.getElementById("flexSwitchCheckDefault");
                    const lanjutButton = document.getElementById("submitButton");
                    const simpanButton = document.getElementById("saveButton");
            
                    switchButton.addEventListener("change", function() {
                        if (this.checked) {
                            lanjutButton.classList.add("d-none");
                            simpanButton.classList.remove("d-none");
                        } else {
                            lanjutButton.classList.remove("d-none");
                            simpanButton.classList.add("d-none");
                        }
                    });
                });
            </script>            
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
    <a href="/pilihkursi" class="btn btn-transparent">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
    
    <br>
    <br>
    <h1 style="margin-bottom: 50px;">Pembayaran</h1>
    <p>Detail Pesanan :</p>
    @foreach ($film as $f)
    <div style="display: flex; align-items: flex-start;">
        <img class="card-img-top" src="{{ asset('storage/vidio/'. $f['film']) }}" alt="" style="max-width: 400px; max-height:700px; margin-right: 20px;">
        <div style="display: flex; flex-direction: column;">
            <h2 class="card-title" style="align-self: flex-start; margin-bottom: 50px;">{{ $f['judul'] }}</h2>
            <p class="card-text" style="margin-bottom: 27px;">{{ $f['deskripsi'] }}</p>
            <br>
            
        </div> 
    </div>   
    @endforeach
    <br>
        <!-- Modal Bayar -->
        <div data-bs-toggle="modal" data-bs-target="#exampleModal">
            <button type="button" class="btn btn-primary">Bayar</button>
        </div>
        <!-- End -->
    </div>
@endsection
