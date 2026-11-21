@extends('admin.layout')
@section('judul', 'Pengaturan Situs')
@section('isi')
<h1>Pengaturan Situs</h1>
<p class="muted">Ubah tulisan dan foto di website tanpa mengubah kode. Hasilnya langsung tampil di halaman utama.</p>

<form class="form wide" data-autosave method="POST" enctype="multipart/form-data" action="{{ route('admin.pengaturan.update') }}">
    @csrf @method('PUT')
    <p class="hint">✓ Perubahan tersimpan otomatis. Foto yang dipilih juga langsung tersimpan.</p>

    <h3 class="form-title">Beranda</h3>
    <label>Nama di beranda
        <input type="text" name="hero_nama" value="{{ old('hero_nama', $p['hero_nama']) }}" required>
    </label>
    <label>Sapaan
        <input type="text" name="sapaan" value="{{ old('sapaan', $p['sapaan']) }}" required>
    </label>
    <label>Deskripsi beranda (paragraf 1)
        <textarea name="hero_1" rows="3" required>{{ old('hero_1', $p['hero_1']) }}</textarea>
    </label>
    <label>Deskripsi beranda (paragraf 2)
        <textarea name="hero_2" rows="3" required>{{ old('hero_2', $p['hero_2']) }}</textarea>
    </label>
    <label>Foto profil (jpg/png/webp, maksimal 2 MB)
        @if ($fotoUrl)
            <img class="preview" src="{{ $fotoUrl }}" alt="Foto profil saat ini">
            <small class="muted">Pilih file baru hanya jika ingin mengganti foto.</small>
        @endif
        <input type="file" name="foto" accept="image/*">
    </label>
    <label>Tulisan kecil di foto
        <input type="text" name="tag_foto" value="{{ old('tag_foto', $p['tag_foto']) }}" maxlength="30" required>
    </label>

    <h3 class="form-title">Tentang Saya</h3>
    <label>Paragraf 1
        <textarea name="tentang_1" rows="4" required>{{ old('tentang_1', $p['tentang_1']) }}</textarea>
    </label>
    <label>Paragraf 2
        <textarea name="tentang_2" rows="4" required>{{ old('tentang_2', $p['tentang_2']) }}</textarea>
    </label>
    <label>Paragraf 3
        <textarea name="tentang_3" rows="4" required>{{ old('tentang_3', $p['tentang_3']) }}</textarea>
    </label>

    <h3 class="form-title">Perjalanan Belajar</h3>
    <label>Catatan di bawah garis waktu
        <textarea name="catatan_perjalanan" rows="3" required>{{ old('catatan_perjalanan', $p['catatan_perjalanan']) }}</textarea>
    </label>

    <h3 class="form-title">Hubungi Saya &amp; Footer</h3>
    <label>Kutipan kontak
        <input type="text" name="kutipan_kontak" value="{{ old('kutipan_kontak', $p['kutipan_kontak']) }}" required>
    </label>
    <label>Email
        <input type="email" name="email" value="{{ old('email', $p['email']) }}" required>
    </label>
    <label>Instagram (cukup nama akun, contoh: pmeilaniaa)
        <input type="text" name="instagram" value="{{ old('instagram', $p['instagram']) }}" placeholder="pmeilaniaa" required>
    </label>
    <label>Tautan GitHub (boleh dikosongkan, tombolnya akan disembunyikan)
        <input type="url" name="github" value="{{ old('github', $p['github']) }}" placeholder="https://github.com/namamu">
    </label>
    <label>Tulisan footer
        <input type="text" name="footer" value="{{ old('footer', $p['footer']) }}" required>
    </label>

    <div class="form-actions">
        <button class="btn" type="submit">Simpan &amp; Selesai</button>
    </div>
</form>
@endsection
