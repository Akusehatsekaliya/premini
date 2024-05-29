<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioskop Online</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        body {
            background-color: #011228; /* Ubah kode warna sesuai keinginan */
            color: white; /* Warna teks */
        }

        .carousel-inner .carousel-item img {
            height: 500px; /* Tinggi yang diinginkan */
            object-fit: cover; /* Gunakan object-fit untuk menjaga rasio aspek gambar */
        }

        .navbar-hidden {
            transform: translateY(-100%);
            transition: transform 0.3s;
        }

        .navbar-visible {
            transform: translateY(0);
            transition: transform 0.3s;
        }

        a {
            text-decoration: none;
            color: inherit; /* Gunakan warna teks dari elemen induk */
        }

        /* Atur elemen <a> untuk tampak seperti button kecil */
        a.button-style {
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #009deb; /* Warna latar belakang (contoh: merah) */
            color: white; /* Warna teks */
            text-align: center;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        /* Hover effect untuk elemen <a> dengan kelas button-style */
        a.button-style:hover {
            background-color: #005b8f; /* Warna latar belakang saat dihover */
        }

        .multiple-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .active-menu {
            color: white !important; /* Warna teks putih */
        }
    </style>
</head>
 
<body>
    <div id="app">
        <nav id="navbar" class="navbar fixed-top navbar-expand-lg navbar-dark border-bottom" style="background-color: #0E46A3;">
            <div class="container">
                <a class="navbar-brand" href="/">FILMKUY</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item @if(!Auth::check()) d-none @endif">
                            <a class="nav-link @if(Request::is('/')) active-menu @endif" href="/"><i class="bi bi-house-door"></i>Home</a>
                        </li>
                        <li class="nav-item @if(!Auth::check()) d-none @endif">
                            <a class="nav-link @if(Request::is('/daftarfilm')) active-menu @endif" href="#listFilm"><i class="bi bi-card-checklist"></i> List Film</a>
                        </li>
                        <li class="nav-item @if(!Auth::check()) d-none @endif">
                            @auth
                                <a class="nav-link @if(Request::is('history/*')) active-menu @endif" href="{{ route('history', ['user_id' => Auth::id()]) }}">
                                    <i class="bi bi-clock-history"></i> History
                                </a>
                            @endauth
                        </li>                              
                        @if (Route::has('login'))
                            <div class="sm:fixed sm:right-0 text-right ms-5">
                                @auth
                                    <div class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="userDropdown" style="transform: translateY(-10px); left: 0;">
                                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                            <li class="border-t border-white-light dark:border-white-light/10">
                                                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="button" id="logoutButton" class="dropdown-item text-danger">
                                                        <svg class="h-4.5 w-4.5 rotate-90 ltr:mr-5 rtl:ml-2" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.5" d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                            <path d="M12 15L12 2M12 2L15 5.5M12 2L9 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        Log out
                                                    </button>
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
                                                                document.getElementById('logoutForm').submit();
                                                            }
                                                        });
                                                    });
                                                </script>
                                                
                                            </li>                                            
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="button-style font-semibold">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="button-style font-semibold ml-4">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Konten utama -->
        <main class="py-4">
            @yield('content')
        </main>

        <footer>
            <!-- Your footer content here -->
        </footer>
    </div>
    <script>
        var prevScrollPos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollPos > currentScrollPos) {
                document.getElementById("navbar").classList.remove("navbar-hidden");
                document.getElementById("navbar").classList.add("navbar-visible");
            } else {
                document.getElementById("navbar").classList.remove("navbar-visible");
                document.getElementById("navbar").classList.add("navbar-hidden");
            }
            prevScrollPos = currentScrollPos;
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</body>
</html>