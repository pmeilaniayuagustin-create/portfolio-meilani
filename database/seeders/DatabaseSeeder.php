<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin. Sandi disimpan dalam bentuk hash (terenkripsi) di database.
        // Jangan unggah file ini ke GitHub publik karena berisi sandi asli.
        User::where('email', 'admin@meilani.test')->delete(); // hapus akun contoh lama jika ada
        User::updateOrCreate(
            ['email' => config('admin.email')],
            ['name' => 'Meilani', 'password' => Hash::make(config('admin.password'))]
        );

        // Kemampuan
        $kemampuan = [
            ['HTML', 80], ['CSS', 75], ['JavaScript', 45], ['Figma', 70],
            ['GitHub', 55], ['PHP', 40], ['Laravel', 50],
        ];
        foreach ($kemampuan as $i => [$nama, $persen]) {
            Skill::create(['nama' => $nama, 'persen' => $persen, 'urutan' => $i + 1]);
        }

        // Pendidikan
        $pendidikan = [
            ['SD Negeri 1 Guyangan', 'Sekolah Dasar'],
            ['SMP Negeri 2 Bangsri', 'Sekolah Menengah Pertama'],
            ['SMK Negeri 1 Bangsri', 'Kelas XI PPLG 2'],
        ];
        foreach ($pendidikan as $i => [$nama, $ket]) {
            Education::create(['kategori' => 'pendidikan', 'nama' => $nama, 'keterangan' => $ket, 'urutan' => $i + 1]);
        }

        // Organisasi dan kegiatan
        foreach (['Pencak Silat Cempaka Putih', 'IPNU IPPNU Guyangan 2', 'Webdev Taksan Nawasena', 'Jurnalistik Anwa Sanskara'] as $i => $nama) {
            Education::create(['kategori' => 'kegiatan', 'nama' => $nama, 'urutan' => $i + 1]);
        }

        // Tiga kartu organisasi utama (foto diunggah lewat halaman admin)
        $organisasi = [
            ['Pencak Silat Cempaka Putih', 'Telah mengikuti pencak silat selama kurang lebih 6 tahun. Selama itu, saya aktif mengikuti berbagai perlombaan, terutama saat SD, dan berhasil memperoleh beberapa prestasi. Selain mengembangkan kemampuan bela diri, saya juga mendapatkan banyak pengalaman, teman, serta nilai kedisiplinan dan sportivitas.'],
            ['IPNU IPPNU Guyangan 2', 'Dipercaya menjadi Koordinator Departemen Olahraga dan Seni. Melalui organisasi ini, saya memperoleh pengalaman baru dalam berorganisasi, bekerja sama, dan berinteraksi dengan teman-teman dari berbagai rentang usia. Hingga saat ini, saya masih aktif berkontribusi di dalamnya.'],
            ['Webdev Taksan Nawasena', 'Bergabung karena memiliki keterkaitan dengan jurusan PPLG serta ketertarikan saya terhadap dunia teknologi dan pengembangan web. Di sini, saya dipercaya oleh teman-teman dan kakak tingkat untuk menjadi bagian dari BPH. Saya mendapatkan banyak pengalaman baru, mulai dari memahami proses pengembangan website, belajar bekerja sama dalam tim, mengelola organisasi, hingga mengembangkan kemampuan komunikasi dan kepemimpinan. Selain menambah wawasan di bidang teknologi, ekstrakurikuler ini juga melatih kemandirian, keberanian, tanggung jawab, serta kemampuan saya dalam menghadapi berbagai tantangan.'],
            ['Jurnalistik Anwa Sanskara', 'Mulai tertarik dengan dunia jurnalistik sejak kelas 10. Di sini, saya belajar berbagai hal, mulai dari desain, teknik dokumentasi yang baik, hingga mengembangkan kreativitas dan kemampuan bekerja dalam tim. Selain itu di jurnalistik aku belajar menulis, mencari informasi, dan menyampaikan cerita dengan jelas. Dari sini aku melatih komunikasi, ketelitian, dan rasa ingin tahu terhadap hal-hal di sekitar.'],
        ];
        foreach ($organisasi as $i => [$nama, $desk]) {
            Organization::create(['nama' => $nama, 'deskripsi' => $desk, 'urutan' => $i + 1]);
        }

        // Hasil karya
        $karya = [
            ['Website ResepKita', 'ResepKita merupakan website yang menyediakan berbagai resep makanan dan minuman khas Nusantara dari berbagai daerah di Indonesia. Website ini dilengkapi informasi deskripsi resep, asal daerah, alat dan bahan, serta waktu pengerjaan. Pengguna juga dapat menambahkan resep ke favorit dan memasukkan resep ke keranjang belanja yang secara otomatis mengumpulkan bahan-bahan yang dibutuhkan. Proyek ini saya buat menggunakan HTML, CSS, dan JavaScript.'],
            ['Web Portofolio', 'Website portofolio pribadi yang saya buat sebagai media personal branding untuk memperkenalkan diri, kemampuan, pendidikan, pengalaman organisasi, perjalanan belajar, hingga hasil karya. Website ini dibangun menggunakan Laravel dan PHP dengan fitur yang dinamis, bukan sekadar tampilan statis. Saya juga menerapkan konsep CRUD (Create, Read, Update, Delete) untuk mengelola data yang terdapat di dalam website.'],
            ['ATHENA UI/UX Design Aplikasi Parfum', 'ATHENA merupakan konsep desain aplikasi mobile untuk brand parfum yang saya rancang menggunakan Figma. Dalam proyek ini, saya membuat tampilan aplikasi mulai dari halaman pembuka, beranda, hingga detail produk. Desain ini berfokus pada tampilan yang elegan, menarik, dan mudah digunakan, sekaligus menjadi sarana saya untuk mengembangkan kreativitas serta kemampuan dalam merancang antarmuka dan pengalaman pengguna (UI/UX).'],
        ];
        foreach ($karya as $i => [$nama, $desk, $tek]) {
            Project::create(['nama' => $nama, 'deskripsi' => $desk, 'teknologi' => $tek, 'urutan' => $i + 1]);
        }
    }
}
