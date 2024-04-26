@extends('admin.main')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('assets/css/kursi.min.css') }}">

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jumlah Kursi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('adminproses_kursi') }}" method="post">
                @csrf
                <div class="form-froup">
                    <label for="judul"> Kursi</label>
                    <input type="number" class="form-control" id="kursi" name="kursi" placeholder="jumlah kursi" value="{{ old('kursi') }}" min="1" max="30">
                    @error('kursi')
                         <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-simple-add"></i>
                            </div>
                        </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Tambah Jumlah Kursi</p>
                                    <a style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <p class="card-title" style="color: success">Klik</p>
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end col --}}
        @foreach ($kursi as $k)
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Jumlah Kursi</p>
                      <p class="card-title">{{ $k->kursi }}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                    <div style="text-align: right ;display: flex;">

                        <div id="btn-edit{{ $k->id }}" class="btn-edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m16.475 5.408l2.117 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621"/><path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3"/></g></svg>
                        </div>
                        <div>
                            <a data-toggle="modal" data-target="#modal-hapus{{ $k->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16l-1.58 14.22A2 2 0 0 1 16.432 22H7.568a2 2 0 0 1-1.988-1.78zm3.345-2.853A2 2 0 0 1 9.154 2h5.692a2 2 0 0 1 1.81 1.147L18 6H6zM2 6h20m-12 5v5m4-5v5"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          {{-- modal edit --}}
          <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Kursi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('adminupdate_kursi',['id'=>$k->id]) }}" method="post">
                        @csrf
                        <div class="form-froup">
                            <label for="kursi"> Jumlah Kursi </label>
                            <input type="number" class="form-control" id="kursi" name="kursi" value="{{ $k->kursi }}">
                            @error('kursi')
                                 <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                </div>
              </div>
            </div>
          </div>
          {{-- end --}}

          {{-- modal hapus --}}
          <div class="modal fade" id="modal-hapus{{ $k->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Apakah kamu yakin ingin menghapus data admin <b>{{ $k->kursi}}</b></p>
                </div>
                <div class="modal-footer justify-content-between">
                  <form action="{{ route('admindelete_kursi',['id' => $k->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-default ml-auto" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                  </form>
              </div>
              </div>
          {{-- end --}}
        @endforeach
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    $('.btn-edit').click(function() {
        $('#ModalEdit').modal('show');
    })
  </script>
@endsection
