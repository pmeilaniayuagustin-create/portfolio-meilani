<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends BaseController
{
    private function aturan(): array
    {
        return [
            'nama'      => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string', 'max:2000'],
            'foto'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'urutan'    => ['nullable', 'integer'],
        ];
    }

    private function atribut(): array
    {
        return ['nama' => 'Nama organisasi', 'deskripsi' => 'Deskripsi', 'foto' => 'Foto', 'urutan' => 'Urutan'];
    }

    public function index()
    {
        $items = Organization::orderBy('urutan')->orderBy('id')->get();
        return view('admin.organizations.index', compact('items'));
    }

    public function create()
    {
        return view('admin.organizations.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan(), $this->atribut());
        $data['foto']   = $this->simpanFoto($request, 'organisasi');
        $data['urutan'] = $data['urutan'] ?? 0;
        Organization::create($data);

        return redirect()->route('admin.organisasi.index')->with('sukses', 'Organisasi berhasil ditambahkan.');
    }

    public function edit(Organization $organization)
    {
        return view('admin.organizations.form', ['item' => $organization]);
    }

    public function update(Request $request, Organization $organization)
    {
        $data = $request->validate($this->aturan(), $this->pesan(), $this->atribut());
        $data['foto']   = $this->simpanFoto($request, 'organisasi', $organization->foto);
        $data['urutan'] = $data['urutan'] ?? 0;
        $organization->update($data);

        return $this->balas($request, 'admin.organisasi.index', 'Organisasi berhasil diperbarui.', ['foto_url' => $organization->fresh()->foto_url]);
    }

    // Ganti foto langsung dari halaman daftar (tersimpan otomatis)
    public function foto(Request $request, Organization $organization)
    {
        $request->validate(['foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']], $this->pesan(), ['foto' => 'Foto']);
        $organization->update(['foto' => $this->simpanFoto($request, 'organisasi', $organization->foto)]);

        return response()->json(['ok' => true, 'pesan' => 'Foto berhasil diganti.', 'foto_url' => $organization->fresh()->foto_url]);
    }

    public function destroy(Organization $organization)
    {
        $this->hapusFoto($organization->foto);
        $organization->delete();

        return redirect()->route('admin.organisasi.index')->with('sukses', 'Organisasi berhasil dihapus.');
    }
}
