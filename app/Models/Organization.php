<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'foto', 'urutan'];

    // Alamat gambar yang bisa langsung dipakai di Blade
    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}
