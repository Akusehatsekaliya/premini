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
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Tabel Film</h4>
                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <p class="card-category"> Tambah</p>
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                <tr>
                    <thead class=" text-primary">
                        <th>
                            Judul
                        </th>
                      <th>
                         Film
                      </th>
                      <th>
                        Kursi
                      </th>
                      <th>
                        Deskripsi
                      </th>
                      <th class="text-center">
                        Aksi
                      </th>
                    </thead>
                </tr>
                <tbody>
                  @if($film->isEmpty())
                  <tr>
                      <td colspan="4" style="text-align:center;">Data masih kosong</td>
                    <td></td>
                    </tr>
                  @else
                    @foreach ($film as $f)
                      <tr>
                        <td>
                            {{ $f->judul }}
                        </td>
                        <td>
                           {{ $f->film }}
                        </td>
                        <td>
                          {{ $f->kursi }}
                        </td>
                        <td>
                            {{ $f->deskripsi }}
                        </td>
                      </tr>
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

