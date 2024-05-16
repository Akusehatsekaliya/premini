@extends('admin.main')
@section('content')
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Data Keuangan</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    Nama
                  </th>
                  <th>
                    Tiket
                  </th>
                  <th>
                    Status
                  </th>
                  <th class="text-right">
                    Uang Masuk
                  </th>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $p)
                    <tr>
                      <td>
                        {{ $p->nama }}
                      </td>
                      <td>
                       {{ $p->tiket }}
                      </td>
                      <td>
                        {{ $p->status }}
                      </td>
                      <td class="text-right">
                        {{ $p->uang }}
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
