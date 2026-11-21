<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Portofolio Meilani')</title>
    <meta name="description" content="Portofolio pribadi Puji Mei Lani Ayu Agustin (Meilani), siswi PPLG SMK Negeri 1 Bangsri.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:ital,wght@0,500;0,700;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script>try{var t=localStorage.getItem('tema');if(t)document.documentElement.dataset.theme=t}catch(e){}</script>
</head>
<body>

{{-- Kumpulan dekorasi SVG (dipakai berulang lewat <use>) --}}
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <defs>
        <symbol id="i-flower" viewBox="0 0 100 100">
            <g fill="currentColor">
                <ellipse cx="50" cy="27" rx="14" ry="22"/>
                <ellipse cx="50" cy="27" rx="14" ry="22" transform="rotate(72 50 50)"/>
                <ellipse cx="50" cy="27" rx="14" ry="22" transform="rotate(144 50 50)"/>
                <ellipse cx="50" cy="27" rx="14" ry="22" transform="rotate(216 50 50)"/>
                <ellipse cx="50" cy="27" rx="14" ry="22" transform="rotate(288 50 50)"/>
            </g>
            <circle cx="50" cy="50" r="11" fill="#F6E7A6"/>
        </symbol>
        <symbol id="i-star" viewBox="0 0 100 100">
            <path fill="currentColor" d="M50 0C54 36 64 46 100 50 64 54 54 64 50 100 46 64 36 54 0 50 36 46 46 36 50 0Z"/>
        </symbol>
        <symbol id="i-ribbon" viewBox="0 0 100 100">
            <g fill="currentColor">
                <path d="M50 46C30 16 4 22 7 46 4 70 30 76 50 46Z"/>
                <path d="M50 46C70 16 96 22 93 46 96 70 70 76 50 46Z"/>
                <path d="M45 52 36 92 48 84 50 96 52 84 64 92 55 52Z" opacity=".85"/>
            </g>
            <circle cx="50" cy="46" r="8" fill="#8B7167" opacity=".35"/>
        </symbol>
        <symbol id="i-heart" viewBox="0 0 100 100">
            <path fill="currentColor" d="M50 90C10 60 2 38 14 22 26 8 44 14 50 28 56 14 74 8 86 22 98 38 90 60 50 90Z"/>
        </symbol>
    </defs>
</svg>

<header class="nav" id="nav">
    <a href="#beranda" class="logo">meilani<span>.</span></a>
    <nav class="nav-menu" id="navMenu">
        <a href="#beranda">Beranda</a>
        <a href="#tentang">Tentang Saya</a>
        <a href="#kemampuan">Kemampuan</a>
        <a href="#perjalanan">Perjalanan Belajar</a>
        <a href="#karya">Hasil Karya</a>
        <a href="#kontak">Hubungi Saya</a>
    </nav>
    <div class="nav-actions">
        <button class="theme-toggle" id="themeToggle" type="button" aria-label="Ganti tema gelap atau terang">☾</button>
        <button class="nav-toggle" id="navToggle" type="button" aria-label="Buka menu"><span></span><span></span></button>
    </div>
</header>

<main>
    @yield('isi')
</main>

<footer class="footer">
    <div class="footer-deco">
        <svg class="d-flower"><use href="#i-flower"/></svg>
        <svg class="d-star"><use href="#i-star"/></svg>
        <svg class="d-flower pink"><use href="#i-flower"/></svg>
        <svg class="d-star"><use href="#i-star"/></svg>
        <svg class="d-flower"><use href="#i-flower"/></svg>
    </div>
    <p>{{ $p['footer'] }}</p>
    <a class="admin-link" href="{{ route('login') }}">✿ Masuk Admin</a>
</footer>

<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
