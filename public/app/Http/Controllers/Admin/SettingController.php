<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    // Kolom teks yang disimpan ke tabel settings
    private const KOLOM = [
        'hero_nama', 'sapaan', 'hero_1', 'hero_2', 'tag_foto',
        'tentang_1', 'tentang_2', 'tentang_3', 'catatan_perjalanan',
        'kutipan_kontak', 'email', 'instagram', 'github', 'footer',
    ];

    public function edit()
    {
        $p = Setting::semua();
        $fotoUrl = $p['foto_profil'] ? asset('storage/' . $p['foto_profil']) : null;

        return view('admin.settings.edit', compact('p', 'fotoUrl'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_nama'          => ['required', 'string', 'max:100'],
            'sapaan'             => ['required', 'string', 'max:100'],
            'hero_1'             => ['required', 'string', 'max:500'],
            'hero_2'             => ['required', 'string', 'max:500'],
            'tag_foto'           => ['required', 'string', 'max:30'],
            'tentang_1'          => ['required', 'string', 'max:1500'],
            'tentang_2'          => ['required', 'string', 'max:1500'],
            'tentang_3'          => ['required', 'string', 'max:1500'],
            'catatan_perjalanan' => ['required', 'string', 'max:600'],
            'kutipan_kontak'     => ['required', 'string', 'max:300'],
            'email'              => ['required', 'email', 'max:100'],
            'instagram'          => ['required', 'string', 'max:150'],
            'github'             => ['nullable', 'url', 'max:200'],
            'footer'             => ['required', 'string', 'max:150'],
            'foto'               => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], $this->pesan(), [
            'hero_nama' => 'Nama di beranda', 'sapaan' => 'Sapaan', 'hero_1' => 'Deskripsi beranda 1',
            'hero_2' => 'Deskripsi beranda 2', 'tag_foto' => 'Tulisan di foto', 'tentang_1' => 'Paragraf 1',
            'tentang_2' => 'Paragraf 2', 'tentang_3' => 'Paragraf 3', 'catatan_perjalanan' => 'Catatan perjalanan',
            'kutipan_kontak' => 'Kutipan kontak', 'email' => 'Email', 'instagram' => 'Instagram',
            'github' => 'Tautan GitHub', 'footer' => 'Tulisan footer', 'foto' => 'Foto profil',
        ]);

        foreach (self::KOLOM as $kunci) {
            Setting::updateOrCreate(['kunci' => $kunci], ['nilai' => $data[$kunci] ?? null]);
        }

        // Foto profil: simpan yang baru, hapus yang lama
        $lama = Setting::where('kunci', 'foto_profil')->value('nilai');
        $baru = $this->simpanFoto($request, 'profil', $lama);
        Setting::updateOrCreate(['kunci' => 'foto_profil'], ['nilai' => $baru]);

        return $this->balas($request, 'admin.pengaturan.edit', 'Pengaturan situs berhasil disimpan.', [
            'foto_url' => $baru ? asset('storage/' . $baru) : null,
        ]);
    }
}
