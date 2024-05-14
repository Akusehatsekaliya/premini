@extends('layouts.app')

@section('content')
<!-- Modal Pembayaran 1 -->
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
                <button type="button" class="btn btn-primary disabled" id="submitButton" data-bs-toggle="modal" data-bs-target="#pembayaran">Lanjut</button>
                <button type="button" class="btn btn-primary d-none disabled" id="saveButton">Simpan</button>
            </div>
            
      </div>
    </div>
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
<!-- End -->

<!-- Modal Pembayaran 2 -->
<div class="modal fade" id="pembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Metode Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="submitForm">
                <p style="font-weight: bold; text-decoration : underline; padding-bottom: 10px;">Pilih Metode Pembayaran</p>
                <div class="form-group">
                    <!-- Bank -->
                    <p style="font-weight:bold">BANK</p>
                    <table>
                        <tr>
                            <td style="padding: 10px">
                                <input class="form-check-input" type="checkbox" id="radioBRI" name="metodePembayaran" value="BRI" onchange="toggleInput()">
                                <label for="radioBRI">
                                    <img src="{{ asset('assets/img/bri.jpg') }}" alt="" height="70px" width="90px">
                                </label>
                            </td>
                            <td style="padding: 10px">
                                <input class="form-check-input" type="checkbox" id="radioBTN" name="metodePembayaran" value="BTN" onchange="togleInput()">
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
                                <input class="form-check-input" type="checkbox" id="gopay" name="metodePembayaran" value="gopay" onchange="toggelInput()">
                                <label for="gopay">
                                    <img src="{{ asset('assets/img/gopay.png') }}" alt="" height="70px" width="70px">
                                </label>
                            </td>
                        </tr>
                    </table>
                    <!-- inputbank -->
                    <div id="inputBank" style="display: none;">
                        <label for="" style="margin-top: 10px; margin-bottom: 10px">Masukkan Nomor Rekening Bank</label>
                        <input type="number" class="form-control" id="nama" name="nama" placeholder="Masukkan Nomor">
                    </div>
                    <!-- inputewallet -->
                    <div id="inputEwallet" style="display: none;">
                        <label for="" style="margin-top: 10px; margin-bottom: 10px">Masukkan Nomor HP</label>
                        <input type="number" class="form-control" id="nama" name="nama" placeholder="Masukkan Nomor">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="button" class="btn btn-primary disabled" id="saveButton">Bayar</button>
        </div>
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
    <script>
        function toggleInput() {
            var inputBank = document.getElementById("inputBank");
            var checkbox = document.getElementById("radioBRI");
    
            // Jika checkbox dicentang, tampilkan input
            if (checkbox.checked) {
                inputBank.style.display = "block";
            } else {
                // Jika tidak, sembunyikan input
                inputBank.style.display = "none";
            }
        }

        function togleInput() {
            var inputBank = document.getElementById("inputBank");
            var checkbox = document.getElementById("radioBTN");
    
            // Jika checkbox dicentang, tampilkan input
            if (checkbox.checked) {
                inputBank.style.display = "block";
            } else {
                // Jika tidak, sembunyikan input
                inputBank.style.display = "none";
            }
        }

        function toggelInput() {
            var inputEwallet = document.getElementById("inputEwallet");
            var checkbox = document.getElementById("gopay");

            if (checkbox.checked) {
                inputEwallet.style.display = "block";
            } else {
                inputEwallet.style.display = "none";
            }
        }
    </script>                
</div>
@endsection
