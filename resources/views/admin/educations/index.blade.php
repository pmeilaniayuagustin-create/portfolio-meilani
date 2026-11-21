@extends('admin.layout')
@section('judul', 'Pendidikan & Kegiatan')
@section('isi')
<div class="page-head">
    <h1>Pendidikan &amp; Kegiatan</h1>
    <a class="btn" href="{{ route('admin.pendidikan.create') }}">+ Tambah</a>
</div>
<div class="table-wrap">
<table class="table">
    <thead><tr><th>Kategori</th><th>Nama</th><th>Keterangan</th><th class="c">Urutan</th><th>Aksi</th></tr></thead>
    <tbody>
    @forelse ($items as $item)
        <tr>
            <td><span class="tag {{ $item->kategori }}">{{ $item->kategori === 'pendidikan' ? 'Pendidikan' : 'Kegiatan' }}</span></td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->keterangan ?: '—' }}</td>
            <td class="c">{{ $item->urutan }}</td>
            <td class="aksi">
                <a href="{{ route('admin.pendidikan.edit', $item) }}">Edit</a>
                <form method="POST" action="{{ route('admin.pendidikan.destroy', $item) }}" onsubmit="return confirm('Hapus data ini?')">
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
