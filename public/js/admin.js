// Simpan otomatis di halaman admin: perubahan langsung dikirim tanpa menekan tombol Simpan.
(function () {
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const badge = document.getElementById('autosave-status');
    let timerBadge;

    function tampilStatus(teks, jenis) {
        badge.textContent = teks;
        badge.className = 'autosave show ' + jenis;
        clearTimeout(timerBadge);
        if (jenis !== 'proses') {
            timerBadge = setTimeout(() => badge.classList.remove('show'), 2600);
        }
    }

    // Kirim data ke server dan baca balasan JSON
    async function kirim(url, formData) {
        const res = await fetch(url, {
            method: 'POST', // Laravel membaca _method (PUT/PATCH) dari formData
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': token },
            body: formData,
        });
        const data = await res.json().catch(() => ({}));
        if (!res.ok) {
            const pesan = data.errors ? Object.values(data.errors)[0][0] : (data.message || 'Gagal menyimpan');
            throw new Error(pesan);
        }
        return data;
    }

    function perbaruiPratinjau(form, url) {
        let img = form.querySelector('img.preview');
        if (!img) {
            img = document.createElement('img');
            img.className = 'preview';
            img.alt = 'Foto saat ini';
            const input = form.querySelector('input[type=file]');
            input.parentNode.insertBefore(img, input);
        }
        img.src = url + '?t=' + Date.now();
    }

    // 1) Formulir edit: simpan otomatis saat diketik / diganti
    document.querySelectorAll('form[data-autosave]').forEach(form => {
        let timer, sedangKirim = false, adaPerubahan = false;

        async function simpan() {
            if (!form.checkValidity()) {
                tampilStatus('Lengkapi isian dulu agar tersimpan', 'gagal');
                return;
            }
            if (sedangKirim) { adaPerubahan = true; return; }
            sedangKirim = true;
            tampilStatus('Menyimpan…', 'proses');
            try {
                const data = await kirim(form.action, new FormData(form));
                tampilStatus('✓ Tersimpan otomatis', 'ok');
                if (data.foto_url) perbaruiPratinjau(form, data.foto_url);
                const berkas = form.querySelector('input[type=file]');
                if (berkas) berkas.value = '';
            } catch (err) {
                tampilStatus(err.message, 'gagal');
            }
            sedangKirim = false;
            if (adaPerubahan) { adaPerubahan = false; simpan(); }
        }

        form.addEventListener('input', e => {
            if (e.target.type === 'file') return;
            clearTimeout(timer);
            timer = setTimeout(simpan, 800); // tunggu berhenti mengetik
        });
        form.addEventListener('change', e => {
            if (e.target.type === 'file' || e.target.tagName === 'SELECT') {
                clearTimeout(timer);
                simpan(); // foto langsung tersimpan
            }
        });
    });

    // 2) Ganti foto langsung dari tabel organisasi / hasil karya
    document.querySelectorAll('input[data-foto-url]').forEach(input => {
        input.addEventListener('change', async () => {
            if (!input.files.length) return;
            const label = input.closest('.foto-ganti');
            label.classList.add('loading');
            tampilStatus('Mengunggah foto…', 'proses');
            try {
                const fd = new FormData();
                fd.append('foto', input.files[0]);
                fd.append('_method', 'PATCH');
                const data = await kirim(input.dataset.fotoUrl, fd);
                const img = label.querySelector('img.thumb');
                const kosong = label.querySelector('.thumb.empty');
                img.src = data.foto_url + '?t=' + Date.now();
                img.hidden = false;
                if (kosong) kosong.hidden = true;
                tampilStatus('✓ Foto tersimpan otomatis', 'ok');
            } catch (err) {
                tampilStatus(err.message, 'gagal');
            }
            label.classList.remove('loading');
            input.value = '';
        });
    });
})();
