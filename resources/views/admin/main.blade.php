<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nucleo-icons/css/nucleo-icons.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
          Admin Bioskop
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="{{ route('admindashboard') }}">
              <i class="nc-icon nc-planet"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="active">
            <a href="{{ route('adminfilm') }}">
              <i class="nc-icon nc-tv-2"></i>
              <p>Film</p>
            </a>
          </li>
          <li class="active">
            <a href="{{ route('adminkursi') }}">
                <i class="nc-icon nc-box-2"></i>
              <p>Kursi</p>
            </a>
          </li>
          <li class="active">
            <a href="{{ route('adminmap') }}">
              <i class="nc-icon nc-pin-3"></i>
              <p>Maps</p>
            </a>
          </li>
          <li class="active">
            <a href="{{ route('admintiket') }}">
                <i class="nc-icon nc-tag-content"></i>
              <p>Tiket</p>
            </a>
          </li>
          <li class="active">
            <a href="{{ route('admintanggal') }}">
              <i class="nc-icon nc-caps-small"></i>
              <p>Tanggal Tayang</p>
            </a>
          </li>
          <li class="active">
            <a href="{{ route('adminkeuangan') }}">
              <i class="nc-icon nc-money-coins"></i>
              <p>Keuangan</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Halaman Admin</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="button" id="logoutButton" class="dropdown-item">Logout</button>
              </form>

              <script>
                  document.getElementById('logoutButton').addEventListener('click', function() {
                      swal({
                          title: "Konfirmasi Logout",
                          text: "Apakah Anda yakin ingin logout?",
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                      })
                      .then((willLogout) => {
                          if (willLogout) {
                              document.getElementById('logout-form').submit();
                          }
                      });
                  });
              </script>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <!-- content -->
      @yield('content')
      <!-- End content -->


    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  @yield('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });

    var currentLocation = window.location.href;

    $('.sidebar-wrapper ul.nav li').each(function() {
      var link = $(this).find('a').attr('href');
      if (currentLocation.indexOf(link) !== -1) {
        $(this).addClass('active');
      } else {
        $(this).removeClass('active');
      }
    });
  </script>
</body>

</html>
