<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
            height: 600px; /* Tinggi yang diinginkan */
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

        .carousel-caption h5,
        .carousel-caption p {
            color: white;
            font-weight: bold;
            font-size: 24px;
        }

        a {
            text-decoration: none;
            color: inherit; /* Gunakan warna teks dari elemen induk */
        }

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
            background-color: #ffffff; /* Mengubah latar belakang menjadi putih */
            padding: 10px;
            margin-top: 75px; /* Add top margin to place the form below the header */
            border-radius: 15px;
            margin-bottom: 20px; /* Add bottom margin to create space between the form and carousel */
            border: 2px solid blue; /* Tambahkan outline biru dengan ketebalan 2px */
        }

        .search-form input {
            width: 100%;
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 5px;
            background-color: #ffffff;
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
            const searchForm = $('#searchForm');
            const headerHeight = $('.navbar').outerHeight();

            if (searchForm.is(':hidden')) {
                searchForm.slideDown('slow', function() {
                    const scrollToPosition = searchForm.offset().top - headerHeight - 10;
                    $('html, body').animate({ scrollTop: scrollToPosition }, 5);
                });
            } else {
                searchForm.slideUp('slow');
            }
        }
    </script>
</head>
 
<body>
    <!-- NAVBAR -->
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
    </nav>
    <!-- END NAVBAR -->
    <!-- Tambahkan elemen <p> untuk menampilkan pesan "Film tidak ditemukan" -->
        <div id="searchForm" class="search-form container">
            <form class="d-flex" role="search">
                <button type="button" onclick="hideSearchForm();" class="btn btn-light me-2">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <input id="searchText" class="form-control" type="search" placeholder="Cari Film Kesayangan.." aria-label="Search">
                <button class="btn btn-warning ms-2" type="button" onclick="searchFilm()">Search</button>
            </form>
        </div>

        <script>
            function searchFilm() {
                const searchText = document.getElementById('searchText').value.toLowerCase();
                
                const filmTitles = Array.from(document.querySelectorAll('.film-title')).map(title => title.textContent.toLowerCase());
        
                if (filmTitles.includes(searchText)) {
                    alert(`Film "${searchText}" ditemukan!`);
                    document.getElementById('noResultMessage').style.display = 'none';
                } else {
                    alert(`Film "${searchText}" tidak ditemukan.`);
                    document.getElementById('noResultMessage').style.display = 'block';
                }
            }

            function hideSearchForm() {
                const searchForm = $('#searchForm');
                const notFoundText = $('#noResultMessage'); // Seleksi elemen teks "Film tidak ditemukan"
                const headerHeight = $('.navbar').outerHeight();

                searchForm.slideUp('slow', function() {
                    const scrollToPosition = searchForm.offset().top - headerHeight - 10;
                    $('html, body').animate({ scrollTop: scrollToPosition }, 500); // Menggunakan animasi untuk menggulung ke atas
                    
                    // Memeriksa apakah hasil pencarian tidak kosong
                    const searchInput = $('.form-control').val(); // Mengambil nilai input pencarian
                    if (!searchInput.trim()) {
                        notFoundText.hide(); // Jika pencarian kosong, teks "Film tidak ditemukan" disembunyikan
                    }
                });
            }
        </script>
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-interval="2000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/bg5.jpg" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Selamat Datang Di Bioskop Online</h5>
                    <p>Aplikasi Pemesanan Tiket Bioskop Online Berbasis Website</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://cdn0-production-images-kly.akamaized.net/-R-vG6P45NFDeImWeiWhkAAH-Wk=/1200x675/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/4612786/original/022012700_1697460840-Main_Poster_Film_Gampang_Cuan_Landscape.jpg" class="d-block w-100" alt="Gambar 2">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
 
    <section id="listFilm">
        <div class="container py-5 text-center">
            <h1 class="title-section">LIST FILM</h1>
    
            <p id="noResultMessage" style="display: none; color: red;">Film tidak ditemukan.</p>
    
            <div class="row mt-5">
                <?php
                $films = [
                    
                ];
            
                if (!empty($films))
                foreach ($films as $film) {
                    $filmTitle = $film['judul'];
                    $filmImage = $film['film'];
                    $ratingCount = $film['rating'];
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-dark h-100">
                            <img src="<?php echo $filmImage; ?>" class="card-img-top rounded" alt="<?php echo $filmTitle; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $filmTitle; ?></h5>
                                <div class="rating">
                                    <span class="star">&#9733;</span>
                                    <span class="star">&#9733;</span>
                                    <span class="star">&#9733;</span>
                                    <span class="star">&#9733;</span>
                                    <span class="star">&#9733;</span>
                                </div>
                                <div class="rating">
                                    <?php
                                    if ($ratingCount > 0) {
                                        for ($i = 0; $i < $ratingCount; $i++) {
                                            echo '<span class="star">&#9733;</span>';
                                        }
                                    } else {
                                        echo 'Belum ada rating';
                                    }
                                    ?>
                                </div>
                                <br>
                                <a href="" class="btn btn-primary">Tonton</a>
                                <a href="" class="btn btn-secondary">Beri Rating</a>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    echo '<div class="col text-center">Tidak ada data film.</div>';
                }
                ?>
                <!-- Pagination -->
                
            </div>
        </div>

    </section>
 
 <!-- SINOPSIS -->
 <section id="sinopsis">
     <div class="container py-5">
         <h1 class="title-section text-center">FILM TERLARIS</h1>
         
         <div class="row d-flex justify-content-center">
             <div class="col-md-6">
                 <div class="sinopsis-text">
                     <h1>Gundala</h1>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, quisquam, deleniti fugit
                         perferendis assumenda, libero earum eum enim tempore ducimus numquam kebutuhan...</p>
                     <div class="mt-5">
                         <a href="/tonton" class="btn btn-outline-primary">NONTON</a>
                         <a href="/detail" class="btn btn-outline-secondary">DETAIL FILM</a>
                     </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="card-sinopsis text-center">
                     <img src="https://m.media-amazon.com/images/M/MV5BYWRlMTQzMzktMzdkMC00ZjU4LWI1ODEtOTA1ZGE0NGU1MmM0XkEyXkFqcGdeQXVyNDA1NDA2NTk@._V1_.jpg" alt="Gundala" style="width: 100%; height: auto; max-width: 300px;">
                 </div>
             </div>
         </div>
 
         <div class="row d-flex justify-content-center mt-5">
             <div class="col-md-6">
                 <div class="sinopsis-text">
                     <h1>Gatot Kaca</h1>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, quisquam, deleniti fugit
                         perferendis assumenda, libero earum eum enim tempore ducimus numquam kebutuhan...</p>
                     <div class="mt-5">
                         <a href="/tonton" class="btn btn-outline-primary">NONTON</a>
                         <a href="/detail" class="btn btn-outline-secondary">DETAIL FILM</a>
                     </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="card-sinopsis text-center">
                     <img src="https://m.media-amazon.com/images/M/MV5BOWEzN2IxOTktMzBjMS00ZWU1LWI0OTgtZjViNWYxOWY1MjUxXkEyXkFqcGdeQXVyNzY4NDQzNTg@._V1_.jpg" alt="Gatot Kaca" style="width: 100%; height: auto; max-width: 300px;">
                 </div>
             </div>
         </div>
     </div>
 </section>
 
 
 <!-- END SINOPSIS -->

 <!-- Nav Active -->
 <script>
     function setActiveMenuItem() {
         // Dapatkan URL saat ini
         const currentUrl = window.location.pathname;

         // Dapatkan semua item menu
         const menuItems = document.querySelectorAll('.navbar-nav .nav-item');

         // Iterasi melalui semua item menu
         menuItems.forEach(item => {
             const link = item.querySelector('a');
             // Jika URL item menu cocok dengan URL saat ini, tambahkan kelas aktif
             if (link.getAttribute('href') === currentUrl || currentUrl.includes(link.getAttribute('href'))) {
                 item.classList.add('active');
             } else {
                 // Hapus kelas aktif jika tidak cocok
                 item.classList.remove('active');
             }
         });
     }

     // Panggil fungsi saat halaman dimuat
     document.addEventListener('DOMContentLoaded', setActiveMenuItem);
 </script>

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
 <!-- JavaScript Bundle with Popper -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
     crossorigin="anonymous"></script>
 <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</body>
</html>