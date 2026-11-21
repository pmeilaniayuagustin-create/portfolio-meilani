@extends('layouts.app')

@php
    $warna = ['#F5C6D0', '#F6E7A6', '#F2B8C6', '#EFD98D', '#F9D5DC', '#E9C7A8', '#F4B6C2'];
@endphp

@section('isi')

{{-- ============ BERANDA ============ --}}
<section class="hero dots" id="beranda">
    <svg class="float f1"><use href="#i-star"/></svg>
    <svg class="float f2"><use href="#i-flower"/></svg>
    <svg class="float f3"><use href="#i-heart"/></svg>
    <svg class="float f4"><use href="#i-star"/></svg>

    <div class="hero-text reveal">
        <p class="eyebrow">portofolio pribadi ✿</p>
        <h1 class="hero-name">{{ $p['hero_nama'] }}</h1>
        <svg class="squiggle" viewBox="0 0 220 14" preserveAspectRatio="none"><path d="M2 8c12-10 20 8 32 0s20 8 32 0 20 8 32 0 20 8 32 0 20 8 32 0 20 8 32 0" fill="none" stroke="#F5C6D0" stroke-width="4" stroke-linecap="round"/></svg>
        <p class="hero-hello">“{{ $p['sapaan'] }}”</p>
        <p>{{ $p['hero_1'] }}</p>
        <p>{{ $p['hero_2'] }}</p>
        <a href="#tentang" class="btn">Jelajahi Portofolio <span>↓</span></a>
    </div>

    <div class="hero-photo reveal">
        <div class="arch">
            <img src="{{ $fotoProfil }}" alt="Foto profil Meilani">
        </div>
        <svg class="ph-ribbon"><use href="#i-ribbon"/></svg>
        <svg class="ph-flower"><use href="#i-flower"/></svg>
        <svg class="ph-star"><use href="#i-star"/></svg>
        <span class="ph-tag">{{ $p['tag_foto'] }}</span>
    </div>
</section>

{{-- ============ TENTANG SAYA ============ --}}
<section class="section" id="tentang">
    <div class="section-head reveal">
        <h2>Tentang <em>Saya</em></h2>
    </div>
    <div class="about reveal">
        <svg class="about-flower"><use href="#i-flower"/></svg>
        <p class="lead">{{ $p['tentang_1'] }}</p>
        <p>{{ $p['tentang_2'] }}</p>
        <p>{{ $p['tentang_3'] }}</p>
    </div>
</section>

{{-- ============ KEMAMPUAN ============ --}}
<section class="section dots" id="kemampuan">
    <div class="section-head reveal">
        <h2>Kemam<em>puan</em></h2>
    </div>
    <div class="skills">
        @forelse ($skills as $i => $s)
            <div class="skill-card reveal">
                <div class="skill-top">
                    <strong>{{ $s->nama }}</strong>
                    <span>{{ $s->persen }}%</span>
                </div>
                <div class="bar"><span style="--w: {{ $s->persen }}%; --c: {{ $warna[$i % count($warna)] }}"></span></div>
            </div>
        @empty
            <p class="kosong">Data kemampuan belum tersedia.</p>
        @endforelse
    </div>
</section>

{{-- ============ PERJALANAN BELAJAR ============ --}}
<section class="section" id="perjalanan">
    <div class="section-head reveal">
        <h2>Perjalanan <em>Belajar</em></h2>
    </div>

    <div class="journey">
        <div class="timeline-box reveal">
            <h3>Riwayat Pendidikan</h3>
            <ul class="timeline">
                @forelse ($pendidikan as $item)
                    <li>
                        <strong>{{ $item->nama }}</strong>
                        @if ($item->keterangan)<small>{{ $item->keterangan }}</small>@endif
                    </li>
                @empty
                    <li>Belum ada data.</li>
                @endforelse
            </ul>
        </div>
        <div class="timeline-box pink reveal">
            <h3>Organisasi dan Kegiatan</h3>
            <ul class="timeline">
                @forelse ($kegiatan as $k)
                    <li>
                        <strong>{{ $k->nama }}</strong>
                        @if ($k->keterangan)<small>{{ $k->keterangan }}</small>@endif
                    </li>
                @empty
                    <li>Belum ada data.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <p class="journey-note reveal">{{ $p['catatan_perjalanan'] }}</p>

    <h3 class="sub-title reveal">Organisasi Utama <small>(klik kartu untuk melihat detail)</small></h3>
    <div class="cards">
        @forelse ($organizations as $o)
            <button type="button" class="card js-card reveal"
                    data-title="{{ $o->nama }}"
                    data-desc="{{ $o->deskripsi }}"
                    data-img="{{ $o->foto_url }}"
                    data-tech="">
                <div class="card-img">
                    @if ($o->foto_url)
                        <img src="{{ $o->foto_url }}" alt="Foto {{ $o->nama }}" loading="lazy">
                    @else
                        <div class="ph"><svg><use href="#i-flower"/></svg></div>
                    @endif
                </div>
                <div class="card-body">
                    <h4>{{ $o->nama }}</h4>
                    <span class="more">Lihat detail →</span>
                </div>
            </button>
        @empty
            <p class="kosong">Data organisasi belum tersedia.</p>
        @endforelse
    </div>
</section>

{{-- ============ HASIL KARYA ============ --}}
<section class="section" id="karya">
    <div class="section-head reveal">
        <h2>Hasil <em>Karya</em></h2>
    </div>
    <div class="cards">
        @forelse ($projects as $item)
            <button type="button" class="card project js-card reveal"
                    data-title="{{ $item->nama }}"
                    data-desc="{{ $item->deskripsi }}"
                    data-img="{{ $item->foto_url }}"
                    data-tech="{{ implode('|', $item->daftarTeknologi()) }}">
                <div class="card-img">
                    @if ($item->foto_url)
                        <img src="{{ $item->foto_url }}" alt="Pratinjau {{ $item->nama }}" loading="lazy">
                    @else
                        <div class="ph yellow"><svg><use href="#i-star"/></svg></div>
                    @endif
                </div>
                <div class="card-body">
                    <h4>{{ $item->nama }}</h4>
                    <div class="chips">
                        @foreach ($item->daftarTeknologi() as $t)
                            <span class="chip">{{ $t }}</span>
                        @endforeach
                    </div>
                    <span class="more">Lihat detail →</span>
                </div>
            </button>
        @empty
            <p class="kosong">Hasil karya belum tersedia.</p>
        @endforelse
    </div>
</section>

{{-- ============ HUBUNGI SAYA ============ --}}
<section class="section contact dots" id="kontak">
    <svg class="float f2"><use href="#i-flower"/></svg>
    <svg class="float f4"><use href="#i-star"/></svg>
    <div class="section-head reveal">
        <h2>Hubungi <em>Saya</em></h2>
    </div>
    <p class="contact-quote reveal">“{{ $p['kutipan_kontak'] }}”</p>
    <div class="contact-buttons reveal">
        @if ($p['email'])
            <a class="btn" href="{{ $emailLink }}" target="_blank" rel="noopener">✉ Kirim Email<small>{{ $p['email'] }}</small></a>
        @endif
        @if ($instagram)
            <a class="btn alt" href="https://instagram.com/{{ $instagram }}" target="_blank" rel="noopener">✿ Instagram<small>&#64;{{ $instagram }}</small></a>
        @endif
        @if ($p['github'])
            <a class="btn soft" href="{{ $p['github'] }}" target="_blank" rel="noopener">★ GitHub<small>Lihat kode proyek</small></a>
        @endif
    </div>
</section>

{{-- ============ TAMPILAN LAYAR PENUH (dipakai organisasi & proyek) ============ --}}
<div class="overlay" id="overlay" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="overlay-panel">
        <button type="button" class="overlay-close" id="overlayClose" aria-label="Tutup">✕</button>
        <div class="overlay-media">
            <img id="ovImg" alt="" hidden>
            <div class="ph big" id="ovPh"><svg><use href="#i-flower"/></svg></div>
        </div>
        <div class="overlay-body">
            <h3 id="ovTitle"></h3>
            <div class="chips" id="ovChips"></div>
            <p id="ovDesc"></p>
        </div>
    </div>
</div>

@endsection
