<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{
    private function aturan(): array
    {
        return [
            'nama'      => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string', 'max:2000'],
            'teknologi' => ['required', 'string', 'max:150'],
            'foto'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'urutan'    => ['nullable', 'integer'],
        ];
    }

    private function atribut(): array
    {
        return ['nama' => 'Nama proyek', 'deskripsi' => 'Deskripsi', 'teknologi' => 'Teknologi', 'foto' => 'Foto', 'urutan' => 'Urutan'];
    }

    public function index()
    {
        $items = Project::orderBy('urutan')->orderBy('id')->get();
        return view('admin.projects.index', compact('items'));
    }

    public function create()
    {
        return view('admin.projects.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan(), $this->atribut());
        $data['foto']   = $this->simpanFoto($request, 'karya');
        $data['urutan'] = $data['urutan'] ?? 0;
        Project::create($data);

        return redirect()->route('admin.karya.index')->with('sukses', 'Hasil karya berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', ['item' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate($this->aturan(), $this->pesan(), $this->atribut());
        $data['foto']   = $this->simpanFoto($request, 'karya', $project->foto);
        $data['urutan'] = $data['urutan'] ?? 0;
        $project->update($data);

        return $this->balas($request, 'admin.karya.index', 'Hasil karya berhasil diperbarui.', ['foto_url' => $project->fresh()->foto_url]);
    }

    // Ganti foto langsung dari halaman daftar (tersimpan otomatis)
    public function foto(Request $request, Project $project)
    {
        $request->validate(['foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']], $this->pesan(), ['foto' => 'Foto']);
        $project->update(['foto' => $this->simpanFoto($request, 'karya', $project->foto)]);

        return response()->json(['ok' => true, 'pesan' => 'Foto berhasil diganti.', 'foto_url' => $project->fresh()->foto_url]);
    }

    public function destroy(Project $project)
    {
        $this->hapusFoto($project->foto);
        $project->delete();

        return redirect()->route('admin.karya.index')->with('sukses', 'Hasil karya berhasil dihapus.');
    }
}
