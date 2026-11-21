<?php

namespace App\Http\Controllers\Admin;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends BaseController
{
    private function aturan(): array
    {
        return [
            'kategori'   => ['required', 'in:pendidikan,kegiatan'],
            'nama'       => ['required', 'string', 'max:100'],
            'keterangan' => ['nullable', 'string', 'max:150'],
            'urutan'     => ['nullable', 'integer'],
        ];
    }

    private function atribut(): array
    {
        return ['kategori' => 'Kategori', 'nama' => 'Nama', 'keterangan' => 'Keterangan', 'urutan' => 'Urutan'];
    }

    public function index()
    {
        $items = Education::orderBy('kategori')->orderBy('urutan')->orderBy('id')->get();
        return view('admin.educations.index', compact('items'));
    }

    public function create()
    {
        return view('admin.educations.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan(), $this->atribut());
        $data['urutan'] = $data['urutan'] ?? 0;
        Education::create($data);

        return redirect()->route('admin.pendidikan.index')->with('sukses', 'Data berhasil ditambahkan.');
    }

    public function edit(Education $education)
    {
        return view('admin.educations.form', ['item' => $education]);
    }

    public function update(Request $request, Education $education)
    {
        $data = $request->validate($this->aturan(), $this->pesan(), $this->atribut());
        $data['urutan'] = $data['urutan'] ?? 0;
        $education->update($data);

        return $this->balas($request, 'admin.pendidikan.index', 'Data berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.pendidikan.index')->with('sukses', 'Data berhasil dihapus.');
    }
}
