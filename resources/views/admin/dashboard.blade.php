@extends('admin.layout')
@section('judul', 'Beranda Admin')
@section('isi')
<h1>Halo, {{ auth()->user()->name }}! ✿</h1>
<p class="muted">Kelola isi portofolio dari sini. Perubahan langsung tampil di website.</p>

<a class="btn pengaturan-link" href="{{ route('admin.pengaturan.edit') }}">⚙ Ubah teks &amp; foto profil di website</a>

<div class="stat-grid">
    <a class="stat" href="{{ route('admin.kemampuan.index') }}"><b>{{ $jumlah['kemampuan'] }}</b><span>Kemampuan</span></a>
    <a class="stat pink" href="{{ route('admin.pendidikan.index') }}"><b>{{ $jumlah['pendidikan'] }}</b><span>Pendidikan &amp; Kegiatan</span></a>
    <a class="stat" href="{{ route('admin.organisasi.index') }}"><b>{{ $jumlah['organisasi'] }}</b><span>Organisasi</span></a>
    <a class="stat pink" href="{{ route('admin.karya.index') }}"><b>{{ $jumlah['karya'] }}</b><span>Hasil Karya</span></a>
</div>
@endsection
