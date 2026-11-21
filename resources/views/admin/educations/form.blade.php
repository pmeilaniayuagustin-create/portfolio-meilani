@extends('admin.layout')
@section('judul', $item ? 'Edit Data' : 'Tambah Data')
@section('isi')
<h1>{{ $item ? 'Edit' : 'Tambah' }} Pendidikan / Kegiatan</h1>
<form class="form" @if ($item) data-autosave @endif method="POST" action="{{ $item ? route('admin.pendidikan.update', $item) : route('admin.pendidikan.store') }}">
    @csrf
    @if ($item) @method('PUT') @endif
    @if ($item)<p class="hint">✓ Perubahan tersimpan otomatis. Foto yang dipilih juga langsung tersimpan.</p>@endif

    <label>Kategori
        <select name="kategori" required>
            <option value="pendidikan" @selected(old('kategori', $item?->kategori) === 'pendidikan')>Riwayat Pendidikan</option>
            <option value="kegiatan" @selected(old('kategori', $item?->kategori) === 'kegiatan')>Organisasi dan Kegiatan</option>
        </select>
    </label>
    <label>Nama
        <input type="text" name="nama" value="{{ old('nama', $item?->nama) }}" required>
    </label>
    <label>Keterangan (boleh dikosongkan)
        <input type="text" name="keterangan" value="{{ old('keterangan', $item?->keterangan) }}">
    </label>
    <label>Urutan tampil
        <input type="number" name="urutan" value="{{ old('urutan', $item?->urutan ?? 0) }}">
    </label>

    <div class="form-actions">
        <button class="btn" type="submit">{{ $item ? 'Selesai' : 'Simpan' }}</button>
        <a class="btn ghost" href="{{ route('admin.pendidikan.index') }}">Batal</a>
    </div>
</form>
@endsection
