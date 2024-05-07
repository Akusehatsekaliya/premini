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
                    <input type="text" class="form-control" name="total" disabled>
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
