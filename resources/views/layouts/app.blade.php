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
    <link rel="stylesheet" type="text/css" href="assets/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="assets/slick/slick-theme.css"/>
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

        .search-form {
            display: none; /* Initially hidden */
            background-color: #e0e0e0;
            padding: 10px;
            margin-top: 75px; /* Add top margin to place the form below the header */
            border-radius: 15px;
            margin-bottom: 20px; /* Add bottom margin to create space between the form and carousel */
        }

        .search-form input {
            width: 100%;
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 5px;
            background-color: #e0e0e0;
            color: black;
        }
        .search-form input::placeholder {
            color: black; /* Placeholder text color */
        }


        .multiple-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <script>
        function toggleSearchForm() {
            const searchForm = document.getElementById('searchForm');
            // Periksa apakah formulir saat ini terlihat
            if (searchForm.style.display === 'block') {
                // Sembunyikan formulir
                searchForm.style.display = 'none';
            } else {
                // Tampilkan formulir
                searchForm.style.display = 'block';
            }
        }
    </script>
</head>
 
<body>
    <div id="app">
        <nav id="navbar" class="navbar fixed-top navbar-expand-lg navbar-dark border-bottom" style="background-color: #0E46A3;">
            <div class="container">
                <a class="navbar-brand" href="#">FILMKUY</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/"><i class="bi bi-house-door"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#listFilm"><i class="bi bi-card-checklist"></i> List Film</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/order"><i class="bi bi-card-text"></i> Beli Tiket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/history"><i class="bi bi-clock-history"></i> History</a>
                        </li>
                        <!-- Bagian navbar -->
                        <li class="nav-item">
                            <a class="nav-link" onclick="toggleSearchForm()">
                                <i class="bi bi-search"></i>
                            </a>
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
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Logout</button>
                                                </form>
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