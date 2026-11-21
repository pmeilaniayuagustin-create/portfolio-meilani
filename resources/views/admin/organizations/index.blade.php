@extends('admin.layout')
@section('judul', 'Organisasi')
@section('isi')
<div class="page-head">
    <h1>Organisasi</h1>
    <a class="btn" href="{{ route('admin.organisasi.create') }}">+ Tambah</a>
</div>
<div class="table-wrap">
<table class="table">
    <thead><tr><th>Foto</th><th>Nama</th><th>Deskripsi</th><th class="c">Urutan</th><th>Aksi</th></tr></thead>
    <tbody>
    @forelse ($items as $item)
        <tr>
            <td style="width:110px">
                <label class="foto-ganti" title="Klik untuk ganti foto">
                    <img class="thumb" src="{{ $item->foto_url }}" alt="" @if (!$item->foto_url) hidden @endif>
                    <span class="thumb empty" @if ($item->foto_url) hidden @endif>✿</span>
                    <small>Ganti foto</small>
                    <input type="file" accept="image/*" hidden data-foto-url="{{ route('admin.organisasi.foto', $item) }}">
                </label>
            </td>
            <td>{{ $item->nama }}</td>
            <td class="desk">{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</td>
            <td class="c">{{ $item->urutan }}</td>
            <td class="aksi">
                <a href="{{ route('admin.organisasi.edit', $item) }}">Edit</a>
                <form method="POST" action="{{ route('admin.organisasi.destroy', $item) }}" onsubmit="return confirm('Hapus organisasi ini?')">
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
