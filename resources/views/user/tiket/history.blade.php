@extends('layouts.app')

@section('content')
<!-- Model Bayar -->
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
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary">Lanjut</button>
        </div>
      </div>
    </div>
</div>
<!-- end Modal Bayar -->
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
        <a href="javascript:history.back()" class="btn btn-transparent">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>        

        <div class="card-title mt-3">
            <h1>History Pembayaran</h1>
        </div>
        @if ($order->isEmpty())
        <table class="table table-responsive table-striped mt-5">
            <thead class="text-center" style="color :#4ac29a">
                <th>No </th>
                <th>Film</th>
                <th>Studio</th>
                <th>Jumlah Tiket</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
            <tbody class="align-middle text-center">
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <span class="badge text-bg-danger">UnPaid</span>
                    </td>
                    <td>
                        <div data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <button type="button" class="btn btn-success">Bayar</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        @else
        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 60vh;">
            <i class="bi bi-clock" style="font-size: 3rem;"></i>
            <p class="center-text">History pesanan Anda akan muncul di sini.</p>
        </div>
        @endif
  

    </div>
@endsection