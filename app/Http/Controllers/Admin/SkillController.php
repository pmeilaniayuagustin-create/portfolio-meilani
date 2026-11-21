<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends BaseController
{
    private function aturan(): array
    {
        return [
            'nama'   => ['required', 'string', 'max:50'],
            'persen' => ['required', 'integer', 'between:0,100'],
            'urutan' => ['nullable', 'integer'],
        ];
    }

    private function atribut(): array
    {
        return ['nama' => 'Nama kemampuan', 'persen' => 'Persentase', 'urutan' => 'Urutan'];
    }

    // READ
    public function index()
    {
        $items = Skill::orderBy('urutan')->orderBy('id')->get();
        return view('admin.skills.index', compact('items'));
    }

    public function create()
    {
        return view('admin.skills.form', ['item' => null]);
    }

    // CREATE
    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan(), $this->atribut());
        $data['urutan'] = $data['urutan'] ?? 0;
        Skill::create($data);

        return redirect()->route('admin.kemampuan.index')->with('sukses', 'Kemampuan berhasil ditambahkan.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.form', ['item' => $skill]);
    }

    // UPDATE
    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate($this->aturan(), $this->pesan(), $this->atribut());
        $data['urutan'] = $data['urutan'] ?? 0;
        $skill->update($data);

        return $this->balas($request, 'admin.kemampuan.index', 'Kemampuan berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.kemampuan.index')->with('sukses', 'Kemampuan berhasil dihapus.');
    }
}
