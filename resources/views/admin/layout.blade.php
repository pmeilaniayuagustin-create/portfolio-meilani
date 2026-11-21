<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('judul') — Admin Meilani</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:ital,wght@0,500;0,700;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script>try{var t=localStorage.getItem('tema');if(t)document.documentElement.dataset.theme=t}catch(e){}</script>
</head>
<body>
<div class="admin-wrap">
    <aside class="sidebar">
        <div class="login-logo">meilani<span>.</span></div>
        <small class="muted">Panel Admin</small>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'on' : '' }}">⌂ Beranda Admin</a>
            <a href="{{ route('admin.pengaturan.edit') }}" class="{{ request()->routeIs('admin.pengaturan.*') ? 'on' : '' }}">⚙ Pengaturan Situs</a>
            <a href="{{ route('admin.kemampuan.index') }}" class="{{ request()->routeIs('admin.kemampuan.*') ? 'on' : '' }}">✿ Kemampuan</a>
            <a href="{{ route('admin.pendidikan.index') }}" class="{{ request()->routeIs('admin.pendidikan.*') ? 'on' : '' }}">✎ Pendidikan &amp; Kegiatan</a>
            <a href="{{ route('admin.organisasi.index') }}" class="{{ request()->routeIs('admin.organisasi.*') ? 'on' : '' }}">♡ Organisasi</a>
            <a href="{{ route('admin.karya.index') }}" class="{{ request()->routeIs('admin.karya.*') ? 'on' : '' }}">★ Hasil Karya</a>
        </nav>
        <div class="side-bottom">
            <button type="button" class="link-btn" id="themeBtn">☾ Ganti tema</button>
            <a href="{{ route('home') }}" target="_blank">Lihat website ↗</a>
            <form method="POST" action="{{ route('logout') }}">@csrf <button type="submit" class="link-btn">Keluar</button></form>
        </div>
    </aside>

    <section class="content">
        @if (session('sukses'))
            <div class="alert ok">{{ session('sukses') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert error">
                <strong>Periksa kembali isian:</strong>
                <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        @yield('isi')
    </section>
</div>
<div id="autosave-status" class="autosave" role="status" aria-live="polite"></div>
<script src="{{ asset('js/admin.js') }}"></script>
<script>
document.getElementById('themeBtn').addEventListener('click', function () {
    var root = document.documentElement;
    var gelap = root.dataset.theme ? root.dataset.theme === 'dark' : matchMedia('(prefers-color-scheme: dark)').matches;
    var baru = gelap ? 'light' : 'dark';
    root.dataset.theme = baru;
    try { localStorage.setItem('tema', baru); } catch (e) {}
});
</script>
</body>
</html>
