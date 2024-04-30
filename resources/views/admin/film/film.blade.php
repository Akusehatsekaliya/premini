@extends('admin.main')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/film.min.css') }}">
    {{-- modal  --}}
   <!-- Button trigger modal -->

  <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Film</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adminproses_film') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-froup">
                        <label for="judul"> Judul </label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Enter judul" value="{{ old('judul') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-froup">
                        <label for="judul"> Film </label>
                        <input type="file" class="form-control" id="film" name="film">
                        @error('film')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kursi_id" class="form-label"> Kursi </label><br>
                        <select class="form-control" name="kursi_id" id="kursi_id">
                            @foreach ($kursi as $k)
                                <option value="{{ $k->id }}">{{ $k->kursi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi"  ></textarea>
                        @error('deskripsi')
                        {{ $message }}
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
                                        <p class="card-category">Tambah Film</p>
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
            @foreach ($film as $f)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                  <div class="card-body ">
                    <div class="row">
                      <div class="col-7 col-md-8">
                        <div class="numbers">
                          <p class="card-category">{{ $f->judul }}</p>
                        </div>

                      </div>
                      <img src="{{ asset('storage/vidio/'. $f->film) }}" alt="" height="200px" width="100px">
                    </div>
                  </div>
                  <div class="card-footer ">
                    <hr>
                    <div class="stats">
                     x ditonton
                    </div>
                    {{-- icones --}}
                    <div style="text-align: right ;display: flex;">

                                <div id="btn-edit{{ $f->id }}" class="btn-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m16.475 5.408l2.117 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621"/><path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3"/></g></svg>
                                </div>

                                <div id="btn-detail" class="btn-detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0"/></svg>
                                </div>

                                <div>
                                    <a data-toggle="modal" data-target="#modal-hapus{{ $f->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16l-1.58 14.22A2 2 0 0 1 16.432 22H7.568a2 2 0 0 1-1.988-1.78zm3.345-2.853A2 2 0 0 1 9.154 2h5.692a2 2 0 0 1 1.81 1.147L18 6H6zM2 6h20m-12 5v5m4-5v5"/></svg>
                                    </a>
                                </div>

                    </div>
                    {{-- end icones --}}

                       {{-- modal edit --}}
                    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Film</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('adminupdate_film',['id'=>$f->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-froup">
                                        <label for="judul"> Judul </label>
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $f->judul }}">
                                        @error('name')
                                             <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-froup">
                                        <label for="judul"> Film </label>
                                        <input type="file" class="form-control" id="film" name="film">
                                        @error('film')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kursi_id" class="form-label"> Kursi </label><br>
                                        <select class="form-control" name="kursi_id" id="kursi_id">
                                            @foreach ($kursi as $k)
                                                <option value="{{ $k->id }}">{{ $k->kursi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi">{{ $f ? $f->deskripsi : '' }}</textarea>
                                        @error('deskripsi')
                                        {{ $message }}
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
                      {{-- end modal edit--}}

                      {{-- modal detail --}}
                      <div class="modal fade" id="Modaldetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Detail Film</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <td>Judul Film</td>
                                        <td></td>
                                        <td>:</td>
                                        <td></td>
                                        <td>{{ $f->judul }}</td>
                                    </tr>
                                    <tr>
                                        <td>p</td>
                                        <td></td>
                                        <td>:</td>
                                        <td></td>
                                        <td><img src="{{ asset('storage/vidio/'. $f->film) }}" alt="" height="70px" width="100px"></td>
                                    </tr>
                                    <tr>
                                        <td>Total Kursi</td>
                                        <td></td>
                                        <td>:</td>
                                        <td></td>
                                        <td>{{ $f->Kursi->kursi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td></td>
                                        <td>:</td>
                                        <td></td>
                                        <td>{{ $f->deskripsi }}</td>
                                    </tr>
                                </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- end modal detail--}}

                      {{-- modal hapus --}}
                      <div class="modal fade" id="modal-hapus{{ $f->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>Apakah kamu yakin ingin menghapus data admin <b>{{ $f->judul}}</b></p>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <form action="{{ route('admindelete_film',['id' => $f->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-default ml-auto" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                              </form>
                          </div>
                          </div>
                          <!-- end modal hapus-->
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
    </div>
@endsection
{{-- end --}}
    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        $('.btn-detail').click(function() {
            $('#Modaldetail').modal('show');
        })
    </script>
    <script>
        $('.btn-edit').click(function() {
            $('#ModalEdit').modal('show');
        })
    </script>
    @endsection
