@extends('admin.layout')
@section('judul', 'Hasil Karya')
@section('isi')
<div class="page-head">
    <h1>Hasil Karya</h1>
    <a class="btn" href="{{ route('admin.karya.create') }}">+ Tambah</a>
</div>
<div class="table-wrap">
<table class="table">
    <thead><tr><th>Foto</th><th>Nama</th><th>Teknologi</th><th class="c">Urutan</th><th>Aksi</th></tr></thead>
    <tbody>
    @forelse ($items as $item)
        <tr>
            <td style="width:110px">
                <label class="foto-ganti" title="Klik untuk ganti foto">
                    <img class="thumb" src="{{ $item->foto_url }}" alt="" @if (!$item->foto_url) hidden @endif>
                    <span class="thumb empty" @if ($item->foto_url) hidden @endif>★</span>
                    <small>Ganti foto</small>
                    <input type="file" accept="image/*" hidden data-foto-url="{{ route('admin.karya.foto', $item) }}">
                </label>
            </td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->teknologi }}</td>
            <td class="c">{{ $item->urutan }}</td>
            <td class="aksi">
                <a href="{{ route('admin.karya.edit', $item) }}">Edit</a>
                <form method="POST" action="{{ route('admin.karya.destroy', $item) }}" onsubmit="return confirm('Hapus hasil karya ini?')">
                    @csrf @method('DELETE')
                    <button class="danger" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="muted">Belum ada data.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
@endsection
