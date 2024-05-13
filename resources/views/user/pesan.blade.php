@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        @endif
    </script>

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
        <a href="javascript:history.back()" class="btn btn-transparent">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <br>
        <br>
        <h1 style="margin-bottom: 50px;">Pesan Film</h1>
        <div style="display: flex; align-items: flex-start;">
            <img class="card-img-top" src="{{ asset('storage/vidio/'. $films->film) }}" alt="" style="max-width: 400px; max-height:700px; margin-right: 20px;">
            <div style="display: flex; flex-direction: column;">
                <h2 class="card-title" style="align-self: flex-start; margin-bottom: 50px;">{{ $films->judul }}</h2>
                <p class="card-text" style="margin-bottom: 27px;">{{ $films->deskripsi }}</p>
            </div>
        </div>
        <div style="margin-top: 20px;"></div>

        <form action="/pesan" method="POST">
            @csrf
            @foreach ($tiket as $key => $t)
            <div style="display: flex; align-items: center;">
                <div style="flex: 1;">
                    <label>
                        <div class="form-check form-switch">
                            <input id="switch-{{ $key }}" class="form-check-input" type="checkbox" name="selectedTicket" value="{{ $t->tiket }}" onclick="handleSwitchClick('{{ $key }}')" {{ $t == $t->tiket ? 'checked' : '' }}>
                            <label class="form-check-label" for="switch-{{ $key }}">{{ $t->tiket }}</label>
                        </div>
                    </label>
                </div>

                <script>
                    function handleSwitchClick(clickedIndex) {
                        var switches = document.querySelectorAll('.form-check-input');
                        var clickedSwitch = switches[clickedIndex];
                        var selectedTicketText = document.getElementById('selectedTicketText');

                        // Memperbarui teks pada <p> berdasarkan tiket yang dipilih
                        //if (clickedSwitch.checked) {
                        //    selectedTicketText.textContent = 'Studio: ' + clickedSwitch.value;
                        //} else {
                        //    selectedTicketText.textContent = '';
                        //}

                        // Mematikan semua switch jika switch utama diaktifkan (on)
                        if (clickedSwitch.checked) {
                            for (var i = 0; i < switches.length; i++) {
                                if (i != clickedIndex) {
                                    switches[i].disabled = true;
                                }
                            }
                        } else {
                            // Mengaktifkan kembali semua switch jika switch utama dimatikan (off)
                            for (var i = 0; i < switches.length; i++) {
                                switches[i].disabled = false;
                            }
                        }
                    }
                </script>



                <div style="margin-left: auto;">
                    <p>Rp. {{ number_format($t->harga, 0, ',', '.') }}</p>
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
                                    <button type="button" class="btn btn-outline-primary"  onclick="selectTicket('{{ $t->tiket }} - {{ $button }}'); updateSelectedTime('{{ $button }}')">{{ $button }}</button>
                                </div>
                            @endforeach
                        </div>

                        {{-- Reset time buttons --}}
                        @php
                            $timeButtons = [];
                        @endphp

                        <script>
                            function updateSelectedTime(time) {
                                var selectedTimeElement = document.getElementById('selectedTime');
                                selectedTimeElement.textContent = time;
                            }
                        </script>
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
        </form>


        <div style="margin-bottom: 20px;"></div>
        <div style="margin-top: 20px;"></div>
        @endforeach

        <div style="text-align: end">
            <a href="{{ route('pilihkursi') }}" class="btn btn-primary">Lanjut</a>
        </div>
@endsection
