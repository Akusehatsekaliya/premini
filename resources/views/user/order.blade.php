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
            <form id="submitForm">
                <div class="form-group">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                </div>
                <br>
                <div class="form-group">
                    <label for="noHp" class="form-label">No. HP</label>
                    <input type="number" class="form-control" id="noHp" name="noHp" placeholder="Masukkan Nomor HP">
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
            <div class="form-check form-switch mt-5">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Bayar Nanti Saja</label>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary disabled" id="submitButton" data-bs-toggle="modal">Lanjut</button>
                <button type="button" class="btn btn-primary d-none disabled" id="saveButton">Simpan</button>
            </div>
            
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const form = document.getElementById("submitForm");
                    const namaInput = document.getElementById("nama");
                    const noHpInput = document.getElementById("noHp");
                    const switchButton = document.getElementById("flexSwitchCheckDefault");
                    const lanjutButton = document.getElementById("submitButton");
                    const simpanButton = document.getElementById("saveButton");

                    function checkFormCompletion() {
                        const isFormComplete = namaInput.value.trim() !== "" && noHpInput.value.trim() !== "";
                        const isSwitchChecked = switchButton.checked;
                        const isReadyToSubmit = isFormComplete && (isSwitchChecked || !isSwitchChecked);

                        if (isReadyToSubmit) {
                            lanjutButton.classList.remove("disabled");
                            simpanButton.classList.remove("disabled");
                        } else {
                            lanjutButton.classList.add("disabled");
                            simpanButton.classList.add("disabled");
                        }
                    }

                    form.addEventListener("input", checkFormCompletion);
                    switchButton.addEventListener("change", function() {
                        if (this.checked) {
                            lanjutButton.classList.add("d-none");
                            simpanButton.classList.remove("d-none");
                        } else {
                            lanjutButton.classList.remove("d-none");
                            simpanButton.classList.add("d-none");
                        }
                        checkFormCompletion();
                    });

                    checkFormCompletion();
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

        .detail-info {
            display: flex;
            flex-direction: column;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
        }

        .detail-label {
            min-width: 150px;
        }

        .detail-value {
            flex-grow: 1;
        }
    </style>
    <a href="/pilihkursi" class="btn btn-transparent">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
    
    <br>
    <br>
    <h1 style="margin-bottom: 50px;">Pembayaran</h1>
    <h4>Detail Pesanan </h4>
    <div style="margin-top: 20px">
        <div class="detail-info">
            <div class="detail-row">
                <p class="detail-label">Film </p>
                <p class="detail-value">:</p>
            </div>
            <div class="detail-row">
                <p class="detail-label">Tiket </p>
                <p class="detail-value">:</p>
            </div>
            <div class="detail-row">
                <p class="detail-label">Jam </p>
                <p class="detail-value">:</p>
            </div>
            <div class="detail-row">
                <p class="detail-label">Jumlah Tiket </p>
                <p class="detail-value">: </p>
            </div>
            <div class="detail-row">
                <p class="detail-label">Nomor Kursi </p>
                <p class="detail-value">: </p>
            </div>
        </div>
    </div>
    <br>
    <!-- Modal Bayar -->
    <div data-bs-toggle="modal" data-bs-target="#exampleModal">
        <button type="button" class="btn btn-primary">Bayar</button>
    </div>
    <!-- End -->
</div>
@endsection
