@extends('admin.main')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header ">
              <h5 class="card-title">Users Behavior</h5>
              <p class="card-category">24 Hours performance</p>
            </div>
            <div class="card-body ">
              <canvas id=chartHours width="400" height="100"></canvas>
            </div>
            <div class="card-footer ">
              <div class="stats">
                <i class="fa fa-history">Updated 3 minutes ago</i>3
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
