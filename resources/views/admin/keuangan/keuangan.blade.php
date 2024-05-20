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
                    No Hp
                  </th>
                  <th>
                    Tiket
                  </th>
                  <th class="text-right">
                    Uang Masuk
                  </th>
                </thead>
                <tbody>
                  @if ($pembayaran->isEmpty())
                    <tr>
                      <td colspan="4" style="text-align:center;">Data masih kosong</td>
                    </tr>
                  @else
                    @foreach ($pembayaran as $p)
                    <tr>
                      <td>
                        {{ $p->nama }}
                      </td>
                      <td>
                        {{ $p->noHp }}
                      </td>
                      <td>
                       {{ $p->tiket }}
                      </td>
                      <td class="text-right">
                        {{ $p->uang }}
                      </td>
                    </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
