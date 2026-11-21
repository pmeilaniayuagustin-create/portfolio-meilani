<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index()
    {
        $urut = fn ($q) => $q->orderBy('urutan')->orderBy('id');
        $p = Setting::semua();

        // Instagram: boleh diisi nama akun (pmeilaniaa), @pmeilaniaa, atau link lengkap. Hasilnya selalu nama akun saja.
        $instagram = preg_replace('#^https?://(www\.)?instagram\.com/#i', '', trim($p['instagram']));
        $instagram = trim((string) strtok($instagram, '?/'), '@ ');

        // Tombol Email membuka halaman "tulis pesan" Gmail dengan alamat dan subjek yang sudah terisi
        $emailLink = 'https://mail.google.com/mail/?' . http_build_query([
            'view' => 'cm', 'fs' => 1, 'to' => $p['email'],
            'su'   => 'Halo Meilani, aku mau menyapa!', 'body' => "Halo Meilani,\n\n",
        ]);

        return view('home', [
            'skills'        => $urut(Skill::query())->get(),
            'pendidikan'    => $urut(Education::where('kategori', 'pendidikan'))->get(),
            'kegiatan'      => $urut(Education::where('kategori', 'kegiatan'))->get(),
            'organizations' => $urut(Organization::query())->get(),
            'projects'      => $urut(Project::query())->get(),
            'p'             => $p,
            'instagram'     => $instagram,
            'emailLink'     => $emailLink,
            // urutan: foto dari admin > public/images/profil.jpg > gambar bawaan
            'fotoProfil'    => $p['foto_profil']
                ? asset('storage/' . $p['foto_profil'])
                : (file_exists(public_path('images/profil.jpg')) ? asset('images/profil.jpg') : asset('images/profil.svg')),
        ]);
    }
}
