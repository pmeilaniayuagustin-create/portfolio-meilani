<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Controller dasar admin: berisi pesan validasi Bahasa Indonesia dan fungsi unggah foto.
abstract class BaseController extends Controller
{
    protected function pesan(): array
    {
        return [
            'required'  => ':attribute wajib diisi.',
            'max'       => ':attribute terlalu panjang / terlalu besar (maksimal :max).',
            'integer'   => ':attribute harus berupa angka.',
            'between'   => ':attribute harus di antara :min dan :max.',
            'image'     => ':attribute harus berupa gambar.',
            'mimes'     => ':attribute harus berformat jpg, jpeg, png, atau webp.',
            'in'        => ':attribute tidak valid.',
            'email'     => ':attribute harus berupa alamat email yang benar.',
            'url'       => ':attribute harus berupa tautan lengkap (diawali https://).',
        ];
    }

    // Jika permintaan datang dari simpan otomatis (AJAX) balas JSON, selain itu kembali ke halaman daftar
    protected function balas(Request $request, string $rute, string $pesan, array $tambahan = [])
    {
        if ($request->expectsJson()) {
            return response()->json(array_merge(['ok' => true, 'pesan' => $pesan], $tambahan));
        }
        return redirect()->route($rute)->with('sukses', $pesan);
    }

    // Simpan foto baru (jika ada) dan hapus foto lama
    protected function simpanFoto(Request $request, string $folder, ?string $lama = null): ?string
    {
        if (!$request->hasFile('foto')) {
            return $lama;
        }
        if ($lama) {
            Storage::disk('public')->delete($lama);
        }
        return $request->file('foto')->store($folder, 'public');
    }

    protected function hapusFoto(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
