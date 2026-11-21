<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['kunci', 'nilai'];

    // Mengambil semua pengaturan: nilai dari database menimpa teks bawaan di config/portofolio.php
    public static function semua(): array
    {
        $bawaan = config('portofolio.bawaan');
        $db = static::pluck('nilai', 'kunci')->toArray();
        // isian yang kosong (atau hanya spasi) diabaikan, jadi teks bawaan tetap dipakai
        $db = array_filter($db, fn ($v) => $v !== null && trim($v) !== '');

        return array_merge($bawaan, $db);
    }
}
