@extends('admin.layout')
@section('judul', $item ? 'Edit Kemampuan' : 'Tambah Kemampuan')
@section('isi')
<h1>{{ $item ? 'Edit' : 'Tambah' }} Kemampuan</h1>
<form class="form" @if ($item) data-autosave @endif method="POST" action="{{ $item ? route('admin.kemampuan.update', $item) : route('admin.kemampuan.store') }}">
    @csrf
    @if ($item) @method('PUT') @endif
    @if ($item)<p class="hint">✓ Perubahan tersimpan otomatis. Foto yang dipilih juga langsung tersimpan.</p>@endif

    <label>Nama kemampuan
        <input type="text" name="nama" value="{{ old('nama', $item?->nama) }}" required>
    </label>
    <label>Persentase (0–100)
        <input type="number" name="persen" min="0" max="100" value="{{ old('persen', $item?->persen ?? 50) }}" required>
    </label>
    <label>Urutan tampil (angka kecil tampil lebih dulu)
        <input type="number" name="urutan" value="{{ old('urutan', $item?->urutan ?? 0) }}">
    </label>

    <div class="form-actions">
        <button class="btn" type="submit">{{ $item ? 'Selesai' : 'Simpan' }}</button>
        <a class="btn ghost" href="{{ route('admin.kemampuan.index') }}">Batal</a>
    </div>
</form>
@endsection
