@extends('layouts.app')

@section('content')

    <br>
    <br>
    <div class="container">
        <style>
            .btn-transparent {
                background-color: transparent;
                color: white; /* Warna teks putih */
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            
            .btn-transparent:hover {
                background-color: rgba(255, 255, 255, 0.2); /* Ubah opasitas sesuai kebutuhan */
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
        </style>
        <a href="/" class="btn btn-transparent">
            <i class="bi bi-arrow-left"></i> Back
        </a>

        <br>
        <br>
        <h1>History Pesanan</h1>

        <div id="searchForm" class="search-form container">
            <form class="d-flex" role="search">
                <button type="button" onclick="hideSearchForm();" class="btn btn-light me-2">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <input id="searchText" class="form-control" type="search" placeholder="Cari History Pemesanan" aria-label="Search">
                <button class="btn btn-warning ms-2" type="button" onclick="searchFilm()">Search</button>
            </form>
        </div>

        <script>
            function searchFilm() {
                // Dapatkan nilai input pencarian
                const searchText = document.getElementById('searchText').value.toLowerCase();
                
                // Dapatkan daftar semua judul film
                const filmTitles = Array.from(document.querySelectorAll('.film-title')).map(title => title.textContent.toLowerCase());
        
                // Periksa apakah judul film yang dicari ada dalam daftar film
                if (filmTitles.includes(searchText)) {
                    // Jika ada, tampilkan pesan bahwa film ditemukan
                    alert(`Film "${searchText}" ditemukan!`);
                    // Sembunyikan pesan "Film tidak ditemukan"
                    document.getElementById('noResultMessage').style.display = 'none';
                } else {
                    // Jika tidak, tampilkan pesan bahwa film tidak ditemukan
                    alert(`Film "${searchText}" tidak ditemukan.`);
                    // Tampilkan pesan "Film tidak ditemukan"
                    document.getElementById('noResultMessage').style.display = 'block';
                }
            }
    
            function hideSearchForm() {
                const searchForm = $('#searchForm');
                const notFoundText = $('#noResultMessage');
                const headerHeight = $('.navbar').outerHeight();
    
                searchForm.slideUp('slow', function() {
                    const scrollToPosition = searchForm.offset().top - headerHeight - 10;
                    $('html, body').animate({ scrollTop: scrollToPosition }, 500);
                    notFoundText.hide();
                });
            }

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
    </div>
@endsection