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
            <form id="submitForm">
                <div class="form-group">
                    <label for="total" class="form-label">Total Pesanan</label>
                    <input type="text" class="form-control" id="total" name="total" value="Rp. {{ number_format(0, 0, ',', '.') }}" disabled>
                </div>
                <script>
                    window.onload = function() {
                        const totalHarga = localStorage.getItem('totalHarga');
                        document.getElementById('total').value = "Rp " + totalHarga.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 2 }).replace(/\.00$/, '').replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        setupEventListeners();
                    };

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

                    function toggleButtonState() {
                        const bankChecked = document.getElementById('radioBRI').checked || document.getElementById('radioBTN').checked;
                        const ewalletChecked = document.getElementById('gopay').checked;
                        const switchChecked = document.getElementById('flexSwitchCheckDefault').checked;
                        const bankInput = document.getElementById('inputBank').querySelector('input').value;
                        const ewalletInput = document.getElementById('inputEwallet').querySelector('input').value;

                        const isFormFilled = (bankChecked && bankInput) || (ewalletChecked && ewalletInput) || switchChecked;

                        const submitButton = document.getElementById('submitButton');
                        const saveButton = document.getElementById('saveButton');

                        if (switchChecked) {
                            saveButton.classList.remove('disabled');
                            saveButton.classList.remove('d-none');
                            submitButton.classList.add('d-none');
                        } else if (isFormFilled) {
                            submitButton.classList.remove('disabled');
                            saveButton.classList.add('d-none');
                        } else {
                            submitButton.classList.add('disabled');
                            saveButton.classList.add('disabled');
                            saveButton.classList.add('d-none');
                        }
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
                        <input type="number" class="form-control" id="namaBank" name="namaBank" placeholder="Masukkan Nomor">
                    </div>
                    <!-- inputewallet -->
                    <div id="inputEwallet" style="display: none;">
                        <label for="" style="margin-top: 10px; margin-bottom: 10px">Masukkan Nomor HP</label>
                        <input type="number" class="form-control" id="namaEwallet" name="namaEwallet" placeholder="Masukkan Nomor">
                    </div>
                </div> 
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
    <div style="margin-top: 20px">
        <form id="submitForm">
            <div class="form-group" style="display: flex; align-items: center; margin-bottom: 10px;">
                <label for="nama" class="form-label" style="width: 100px;">Nama :</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
            </div>
            <br>
            <div class="form-group" style="display: flex; align-items: center; margin-bottom: 10px;">
                <label for="noHp" class="form-label" style="width: 100px;">No. HP :</label>
                <input type="number" class="form-control" id="noHp" name="noHp" placeholder="Masukkan Nomor HP">
            </div>              
        </form>
    </div>    
    <br>
    <!-- Modal Bayar -->
    <div data-bs-toggle="modal" data-bs-target="#exampleModal">
        <button type="button" class="btn btn-primary">Bayar</button>
    </div>
    <!-- End -->
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
</div>
@endsection
