@extends('admin.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

{{-- modal edit --}}
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tanggal Tayang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('adminproses_tanggal') }}" method="post">
                @csrf
                <div class="form-froup">
                    <label for="judul"> Hari </label>
                    <input type="text" class="form-control" id="hari" name="hari" placeholder="Enter hari" value="{{ old('hari') }}">
                    @error('hari')
                         <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-froup">
                    <label for="judul"> Tanggal </label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                    @error('tanggal')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-froup">
                    <label for="judul"> Jam Tayang </label>
                    <input type="time" class="form-control" id="jam" name="jam" placeholder="Enter jam" value="{{ old('jam') }}">
                    @error('jam')
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
{{-- end --}}


 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tanggal Tayang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('adminproses_tanggal') }}" method="post">
                @csrf
                <div class="form-froup">
                    <label for="judul"> Hari </label>
                    <input type="text" class="form-control" id="hari" name="hari" placeholder="Enter hari" value="{{ old('hari') }}">
                    @error('hari')
                         <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-froup">
                    <label for="judul"> Tanggal </label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                    @error('tanggal')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-froup">
                    <label for="judul"> Jam Tayang </label>
                    <input type="time" class="form-control" id="jam" name="jam" placeholder="Enter jam" value="{{ old('jam') }}">
                    @error('jam')
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
    {{-- end  --}}
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" style="text-align: center; font-size: 16px; font-weight: bold; color: #424242;"> Tanggal Tayang</h4>
          </div>
          <div class="card-header">
            <a href="" style="text-align: center; font-size: 16px; font-weight: bold; color: #2c443c; text-decoration: underline; cursor: pointer"  data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah jadwal</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th style="color :#4ac29a">
                    Hari
                  </th>
                  <th style="color :#4ac29a">
                    Tanggal
                  </th>
                  <th style="color :#4ac29a">
                    Jam Tayang
                  </th>
                  <th class="text-center" style="color :#4ac29a">
                    Aksi
                  </th>
                </thead>
                <tbody>
                @if($tanggal->isEmpty())
                <tr>
                    <td colspan="4" style="text-align:center;">Data masih kosong</td>
                </tr>
                @else
                @foreach ($tanggal as $t)
                  <tr>
                    <td>
                       {{ $t->hari }}
                    </td>
                    <td>
                      {{ $t->tanggal }}
                    </td>
                    <td>
                      {{ $t->jam }}
                    </td>
                    <td class="text-center">
                        <div id="btn-edit{{ $t->id }}" class="btn-edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m16.475 5.408l2.117 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621"/><path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3"/></g></svg>
                           </div>
                      <a  data-toggle="modal" data-target="#modal-hapus{{ $t->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16l-1.58 14.22A2 2 0 0 1 16.432 22H7.568a2 2 0 0 1-1.988-1.78zm3.345-2.853A2 2 0 0 1 9.154 2h5.692a2 2 0 0 1 1.81 1.147L18 6H6zM2 6h20m-12 5v5m4-5v5"/></svg>
                      </a>
                    </td>
                  </tr>

                  <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('adminupdate_tanggal', $t->id) }}" method="post">
                                @csrf
                                <div class="form-froup">
                                    <label for="hari"> Hari </label>
                                    <input type="text" class="form-control" id="hari" name="hari" value="{{ $t->hari }}">
                                    @error('hari')
                                         <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-froup">
                                    <label for="judul"> Tanggal </label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $t->tanggal }}">
                                    @error('tanggal')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-froup">
                                    <label for="judul"> Jam Tayang </label>
                                    <input type="time" class="form-control" id="jam" name="jam" value="{{ $t->jam }}">
                                    @error('jam')
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
                  </div>

                  <div class="modal fade" id="modal-hapus{{ $t->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah kamu yakin ingin menghapus data <b>{{ $t->hari}}</b></p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <form action="{{ route('admindelete_tanggal',['id' => $t->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-default ml-auto" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Yes</button>
                          </form>
                      </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </tbody>
                @endforeach
              </table>
            </div>
            @endif
          </div>
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
