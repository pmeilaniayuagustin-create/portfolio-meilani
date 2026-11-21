<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'teknologi', 'foto', 'urutan'];

    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }

    // Mengubah "HTML, CSS" menjadi ['HTML', 'CSS']
    public function daftarTeknologi(): array
    {
        return array_values(array_filter(array_map('trim', explode(',', $this->teknologi))));
    }
}
