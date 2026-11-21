@extends('admin.layout')
@section('judul', 'Kemampuan')
@section('isi')
<div class="page-head">
    <h1>Kemampuan</h1>
    <a class="btn" href="{{ route('admin.kemampuan.create') }}">+ Tambah</a>
</div>
<div class="table-wrap">
<table class="table">
    <thead><tr><th class="c">Urutan</th><th>Nama</th><th>Persentase</th><th>Aksi</th></tr></thead>
    <tbody>
    @forelse ($items as $item)
        <tr>
            <td class="c">{{ $item->urutan }}</td>
            <td>{{ $item->nama }}</td>
            <td><div class="mini-bar"><span style="width: {{ $item->persen }}%"></span></div> {{ $item->persen }}%</td>
            <td class="aksi">
                <a href="{{ route('admin.kemampuan.edit', $item) }}">Edit</a>
                <form method="POST" action="{{ route('admin.kemampuan.destroy', $item) }}" onsubmit="return confirm('Hapus kemampuan ini?')">
                    @csrf @method('DELETE')
                    <button class="danger" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="muted">Belum ada data.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
@endsection
