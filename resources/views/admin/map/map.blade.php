@extends('admin.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
{{-- modal tambah --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Google Map</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admintambah_map') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Tambah Link</label>
                    <input class="form-control" type="url" name="map" placeholder="masukkan link">
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
{{-- end modal --}}

<div class="content">
      <div class="col-mb-2">
        <div class="card h-100 ">
          <div class="card-header ">
            <a style="cursor: pointer" id="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <p class="card-title" style="color: rgb(55, 172, 86)">Tambah Maps</p>
            </a>
          <div class="card-body ">
            @if ($map->isEmpty())
            <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Data masih kosong</h5>
                  </div>
              </div>
            </div>
            @else
            @foreach ($map as $m)
            <iframe src="{{ $m->map }}" width="970" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            {{-- icon --}}
            <div style="text-align: right ;display: flex;">

                <div id="btn-edit{{ $m->id }}" class="btn-edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m16.475 5.408l2.117 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621"/><path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3"/></g></svg>
                </div>
                <div>
                    <a data-toggle="modal" data-target="#modal-hapus{{ $m->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16l-1.58 14.22A2 2 0 0 1 16.432 22H7.568a2 2 0 0 1-1.988-1.78zm3.345-2.853A2 2 0 0 1 9.154 2h5.692a2 2 0 0 1 1.81 1.147L18 6H6zM2 6h20m-12 5v5m4-5v5"/></svg>
                    </a>
                </div>
           </div>
            {{-- end --}}

            {{-- modal edit --}}
            <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Film</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('adminupdate_map',['id'=>$m->id]) }}" method="post">
                            @csrf
                            <div class="form-froup">
                                <label for="map"> Link Map </label>
                                <input type="url" class="form-control" id="map" name="map" value="{{ $m->map }}">
                                @error('map')
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
            <div class="modal fade" id="modal-hapus{{ $m->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Apakah kamu yakin ingin menghapus data admin <b>{{ $m->map}}</b></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <form action="{{ route('admindelete_map',['id' => $m->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-default ml-auto" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                      </form>
                  </div>
                  </div>
            {{-- end --}}
            @endforeach
            @endif
          </div>
        </div>
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

