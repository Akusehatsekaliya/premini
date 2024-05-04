@extends('layouts.app')

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>            
            <div class="modal-body">
                <form action="/pesan" method="POST">
                    <div class="form-group col-md-12">
                        <label for="jumlah" class="form-label">Jumlah Tiket :</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Tiket" min="1" max="10" onchange="checkTicketQuantity()">
                        <div id="ticketQuantityWarning" style="display: none; color: red;">Pesan peringatan</div>
                        <input type="hidden" id="selectedTicket" name="selectedTicket" value="">
                    </div>
                </form>
                <script>
                    function checkTicketQuantity() {
                        var jumlahInput = document.getElementById('jumlah');
                        var ticketQuantity = document.getElementById('ticketQuantityWarning');

                        var minPembelian = 1;
                        var maxPembelian = 10;
                    
                        if (jumlahInput.value < minPembelian) {
                            jumlahInput.value = minPembelian;
                            ticketQuantityWarning.innerText = 'Minimal pembelian tiket adalah ' + minPembelian;
                            ticketQuantityWarning.style.display = 'block';
                        } else if (jumlahInput.value > maxPembelian) {
                            jumlahInput.value = maxPembelian;
                            ticketQuantityWarning.innerText = 'Maksimal pembelian tiket adalah ' + maxPembelian;
                            ticketQuantityWarning.style.display = 'block';
                        } else {
                            ticketQuantityWarning.style.display = 'none';
                        }
                    }

                    function selectTicket(tiket) {
                        document.getElementById('selectedTicket').value = tiket;
                    }
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary"  onclick="validateAndRedirect()">Lanjut</button>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script>
                function validateAndRedirect() {
                    var jumlahInput = document.getElementById('jumlah').value;
                    var selectedTicket = document.getElementById('selectedTicket').value;

                    if (jumlahInput === "") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Jumlah tiket tidak boleh kosong!',
                        });
                    } else if (selectedTicket === "") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Harap pilih tiket terlebih dahulu!',
                        });
                    } else {
                        redirectToPilihKursi();
                    }
                }

                function redirectToPilihKursi() {
                    window.location.href = "/pilihkursi?selected=" + document.getElementById('selectedTicket').value;
                }
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
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .btn-transparent:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }
        </style>
        <a href="/detail" class="btn btn-transparent">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <br>
<br>
<h1 style="margin-bottom: 50px;">Pesan Film</h1>
@foreach ($film as $f)
<div style="display: flex; align-items: flex-start;">
    <img class="card-img-top" src="{{ asset('storage/vidio/'. $f['film']) }}" alt="" style="max-width: 400px; max-height:700px; margin-right: 20px;">
    <div style="display: flex; flex-direction: column;">
        <h2 class="card-title" style="align-self: flex-start; margin-bottom: 50px;">{{ $f['judul'] }}</h2>
        <p class="card-text" style="margin-bottom: 27px;">{{ $f['deskripsi'] }}</p>
    </div>
</div>
<div style="margin-top: 20px;"></div>

@foreach ($tiket as $t)
<div style="display: flex; align-items: center;">
    <div style="flex: 1;">
        <p>{{ $t->tiket }}</p>
    </div>
    <div style="margin-left: auto;">
        <p>Rp. {{ number_format($t->harga, 0, ',', '.') }}</p> <!-- Format harga as Indonesian Rupiah -->
    </div>
</div>
<div style="display: flex; flex-direction: column;">
    @php
        $previousDate = null;
        $timeButtons = [];
    @endphp

    @foreach ($tanggal as $t)
        @php
            $formattedDate = \Carbon\Carbon::parse($t->tanggal)->isoFormat('D MMMM YYYY');
        @endphp

        @if ($formattedDate !== $previousDate)
            <div style="margin-bottom: 10px;">
                <div style="margin-right: 10px;">
                    <p>{{ $formattedDate }}</p>
                </div>
            </div>

            {{-- Display time buttons horizontally --}}
            <div style="margin-bottom: 10px; display: flex;">
                @foreach ($timeButtons as $button)
                    <div style="margin-right: 10px;">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="selectTicket('{{ $t->tiket }} - {{ $button }}')">{{ $button }}</button>
                    </div>
                @endforeach
            </div>

            {{-- Reset time buttons --}}
            @php
                $timeButtons = [];
            @endphp
        @endif

        {{-- Collect time buttons --}}
        @php
            $timeButtons[] = rtrim(substr($t->jam, 0, -2), ':');
        @endphp

        @php
            $previousDate = $formattedDate;
        @endphp
    @endforeach

    {{-- Display remaining time buttons --}}
    <div style="margin-bottom: 10px; display: flex;">
        @foreach ($timeButtons as $button)
            <div style="margin-right: 10px;">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="selectTicket('{{ $t->tiket }} - {{ $button }}')">{{ $button }}</button>
            </div>
        @endforeach
    </div>
</div>


<div style="margin-bottom: 20px;"></div>
@endforeach
<div style="margin-top: 20px;"></div>
@endforeach
@endsection