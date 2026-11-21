// ===== Tema gelap / terang =====
const root = document.documentElement;
const themeBtn = document.getElementById('themeToggle');

function terapkanTema(tema) {
    root.dataset.theme = tema;
    themeBtn.textContent = tema === 'dark' ? '☀' : '☾';
    themeBtn.setAttribute('aria-label', tema === 'dark' ? 'Ganti ke tema terang' : 'Ganti ke tema gelap');
}
let temaTersimpan = null;
try { temaTersimpan = localStorage.getItem('tema'); } catch (e) {}
terapkanTema(temaTersimpan || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
window.gantiTema = function () {
    const baru = root.dataset.theme === 'dark' ? 'light' : 'dark';
    terapkanTema(baru);
    try { localStorage.setItem('tema', baru); } catch (e) {}
};
themeBtn.addEventListener('click', window.gantiTema);

// ===== Menu HP =====
const navToggle = document.getElementById('navToggle');
const navMenu = document.getElementById('navMenu');
navToggle.addEventListener('click', () => {
    navToggle.classList.toggle('open');
    navMenu.classList.toggle('open');
});
navMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
    navToggle.classList.remove('open');
    navMenu.classList.remove('open');
}));

// ===== Efek navigasi saat discroll + menu aktif =====
const nav = document.getElementById('nav');
const links = [...navMenu.querySelectorAll('a')];

function onScroll() {
    nav.classList.toggle('scrolled', window.scrollY > 30);
    const y = window.scrollY + 140;
    const sections = links.map(a => document.querySelector(a.getAttribute('href')));
    let aktif = 0;
    sections.forEach((s, i) => { if (s && s.offsetTop <= y) aktif = i; });
    links.forEach((a, i) => a.classList.toggle('active', i === aktif));
}
window.addEventListener('scroll', onScroll, { passive: true });
onScroll();

// ===== Animasi muncul saat discroll =====
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.classList.add('in-view');
            observer.unobserve(e.target);
        }
    });
}, { threshold: 0.15 });
window.pasangReveal = () => document.querySelectorAll('.reveal:not(.in-view)').forEach(el => observer.observe(el));
window.pasangReveal();

// ===== Tampilan layar penuh (organisasi & proyek) =====
const overlay = document.getElementById('overlay');
const ovImg = document.getElementById('ovImg');
const ovPh = document.getElementById('ovPh');
const ovTitle = document.getElementById('ovTitle');
const ovDesc = document.getElementById('ovDesc');
const ovChips = document.getElementById('ovChips');

function bukaOverlay(kartu) {
    const { title, desc, img, tech } = kartu.dataset;

    ovTitle.textContent = title;
    ovDesc.textContent = desc;

    // foto: tampilkan jika ada, kalau tidak pakai gambar hiasan
    if (img) {
        ovImg.src = img;
        ovImg.alt = title;
        ovImg.hidden = false;
        ovPh.hidden = true;
    } else {
        ovImg.hidden = true;
        ovPh.hidden = false;
    }

    // teknologi (hanya untuk proyek)
    ovChips.innerHTML = '';
    if (tech) {
        tech.split('|').forEach(t => {
            const span = document.createElement('span');
            span.className = 'chip';
            span.textContent = t;
            ovChips.appendChild(span);
        });
    }

    overlay.classList.add('open');
    overlay.setAttribute('aria-hidden', 'false');
    overlay.scrollTop = 0;
    document.body.classList.add('lock');
}

function tutupOverlay() {
    overlay.classList.remove('open');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('lock');
}

document.addEventListener('click', e => {
    const kartu = e.target.closest('.js-card');
    if (kartu) bukaOverlay(kartu);
});
document.getElementById('overlayClose').addEventListener('click', tutupOverlay);
document.addEventListener('keydown', e => { if (e.key === 'Escape') tutupOverlay(); });
