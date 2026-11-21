<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk Admin — Portofolio Meilani</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:ital,wght@0,500;0,700;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="login-page">
    <form class="login-card" method="POST" action="{{ route('login.proses') }}">
        @csrf
        <div class="login-logo">meilani<span>.</span></div>
        <p class="muted">Masuk untuk mengelola portofolio ✿</p>

        @if ($errors->any())
            <div class="alert error">{{ $errors->first() }}</div>
        @endif

        <label>Email
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        </label>
        <div class="field">
            <label for="password">Kata Sandi</label>
            <div class="pw-wrap">
                <input type="password" name="password" id="password" required>
                <button type="button" class="pw-toggle" id="pwToggle" aria-label="Tampilkan kata sandi"><svg class="i-open" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg><svg class="i-shut" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg></button>
            </div>
        </div>
        <label class="check"><input type="checkbox" name="ingat" value="1"> Ingat saya</label>

        <button class="btn" type="submit">Masuk</button>
        <a class="back" href="{{ route('home') }}">← Kembali ke website</a>
    </form>
<script>
// Tombol mata: tampilkan / sembunyikan kata sandi
document.getElementById('pwToggle').addEventListener('click', function () {
    var kolom = document.getElementById('password');
    var tampil = kolom.type === 'password';
    kolom.type = tampil ? 'text' : 'password';
    this.classList.toggle('tampil', tampil);
    this.setAttribute('aria-label', tampil ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
    kolom.focus();
});
</script>
</body>
</html>
