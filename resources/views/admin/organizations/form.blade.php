@extends('admin.layout')
@section('judul', $item ? 'Edit Organisasi' : 'Tambah Organisasi')
@section('isi')
<h1>{{ $item ? 'Edit' : 'Tambah' }} Organisasi</h1>
<form class="form" @if ($item) data-autosave @endif method="POST" enctype="multipart/form-data" action="{{ $item ? route('admin.organisasi.update', $item) : route('admin.organisasi.store') }}">
    @csrf
    @if ($item) @method('PUT') @endif
    @if ($item)<p class="hint">✓ Perubahan tersimpan otomatis. Foto yang dipilih juga langsung tersimpan.</p>@endif

    <label>Nama organisasi
        <input type="text" name="nama" value="{{ old('nama', $item?->nama) }}" required>
    </label>
    <label>Deskripsi singkat
        <textarea name="deskripsi" rows="5" required>{{ old('deskripsi', $item?->deskripsi) }}</textarea>
    </label>
    <label>Foto kegiatan (jpg/png/webp, maksimal 2 MB)
        @if ($item?->foto_url)
            <img class="preview" src="{{ $item->foto_url }}" alt="Foto saat ini">
            <small class="muted">Pilih file baru hanya jika ingin mengganti foto.</small>
        @endif
        <input type="file" name="foto" accept="image/*">
    </label>
    <label>Urutan tampil
        <input type="number" name="urutan" value="{{ old('urutan', $item?->urutan ?? 0) }}">
    </label>

    <div class="form-actions">
        <button class="btn" type="submit">{{ $item ? 'Selesai' : 'Simpan' }}</button>
        <a class="btn ghost" href="{{ route('admin.organisasi.index') }}">Batal</a>
    </div>
</form>
@endsection
