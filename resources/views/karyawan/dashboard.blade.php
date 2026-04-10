<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | Hayranfy</title>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Face API -->
<script defer src="https://cdn.jsdelivr.net/npm/face-api.js"></script>

<style>
#map { height: 250px; border-radius: 1rem; margin-top: 1rem; }
@keyframes fadeIn { from { opacity:0; transform: translateY(-5px);} to {opacity:1; transform: translateY(0);} }
.animate-fadeIn { animation: fadeIn 0.3s ease-in-out; }
.opacity-100 { opacity: 1; }
</style>
</head>
<body class="flex flex-col min-h-screen bg-white">

<header class="flex items-center justify-between p-4 text-white bg-gradient-to-r from-blue-900 to-blue-600">
    <div class="flex items-center space-x-2">
        <img src="/logo.png" alt="Logo" class="w-8 h-8">
        <h1 class="text-lg font-bold">Hayranfy</h1>
    </div>
    <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Nama Karyawan' }}</p>
</header>

<main class="flex-1 p-4 pb-20 transition-all duration-300 ease-in-out">
    <div class="flex justify-end mb-5">
        <button id="btnAbsen" class="px-5 py-2 text-white transition bg-blue-900 rounded-full shadow hover:bg-blue-800">
            Absen Sekarang
        </button>
    </div>

    <!-- Riwayat Absen -->
    <section id="sectionRiwayat">
        <h2 class="mb-3 text-lg font-semibold text-gray-800">Riwayat Absen</h2>
        <div id="riwayatAbsen" class="space-y-4">
            @forelse ($riwayatAbsen ?? [] as $absen)
                <div class="flex items-center justify-between px-4 py-3 bg-gray-100 shadow-sm rounded-2xl">
                    <p class="text-sm font-medium text-gray-800 sm:text-base">
                        {{ $absen->tanggal }} {{ $absen->jam_masuk }}
                    </p>
                    <a href="{{ route('karyawan.absen.show', $absen->id) }}" class="px-4 py-2 text-xs text-white transition bg-blue-900 rounded-full sm:text-sm hover:bg-blue-800">
                        Detail
                    </a>
                </div>
            @empty
                <p class="py-10 text-center text-gray-500">Belum ada data absen.</p>
            @endforelse
        </div>
    </section>

    <!-- Halaman Absen Sekarang -->
    <section id="sectionAbsen" class="hidden transition-opacity duration-300 opacity-0">
        <h2 class="mb-4 text-lg font-bold text-gray-800">Absen Sekarang</h2>
        <div class="p-4 bg-gray-100 shadow-sm rounded-2xl">
            <!-- Video Face-ID -->
            <div class="relative flex justify-center mb-4">
                <video id="videoFace" autoplay muted width="200" height="150" class="bg-gray-300 rounded-xl"></video>
                <canvas id="overlayFace" width="200" height="150" class="absolute top-0 left-0"></canvas>
            </div>
            <p id="statusFace" class="mb-4 text-sm text-center text-gray-700">Memuat Face-ID...</p>

            <!-- Info Lokasi & Waktu -->
            <div class="space-y-3 text-sm">
                <div class="flex items-center px-3 py-2 bg-gray-200 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" />
                    </svg>
                    <span id="jarakLokasi">&gt; 1m</span>
                </div>
                <div class="px-3 py-2 bg-gray-200 rounded-lg">
                    Waktu : <span id="waktuSekarang">{{ date('d/m/Y H:i') }}</span>
                </div>
                <div class="inline-block px-3 py-2 bg-gray-200 rounded-lg">
                    <span id="tipeAbsen">Tipe Absen: Masuk</span>
                </div>
            </div>

            <div id="map"></div>
        </div>

        <div class="flex justify-between mt-6">
            <button id="btnKembali" class="px-6 py-2 text-white bg-gray-800 rounded-full hover:bg-gray-700">Kembali</button>
            <button id="btnKirim" class="px-6 py-2 text-white bg-green-500 rounded-full hover:bg-green-600">Kirim</button>
        </div>
    </section>
</main>

<!-- Navigasi Bawah -->
<nav class="fixed bottom-0 left-0 right-0 flex justify-around py-2 shadow-inner bg-gradient-to-r from-blue-900 to-blue-700 rounded-t-2xl">
    <a href="{{ route('karyawan.dashboard') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.dashboard') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
        </svg>
        <span class="text-xs">Absen</span>
    </a>

    <a href="{{ route('karyawan.detail_gaji') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.detail_gaji') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v4a2 2 0 002 2z" />
        </svg>
        <span class="text-xs">Gaji</span>
    </a>

    <a href="{{ route('karyawan.riwayat_pengajuan') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.riwayat_pengajuan') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-xs">Pengajuan</span>
    </a>

    <!-- ini aku benerin routeIs nya -->
    <a href="{{ route('karyawan.profile') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.profile') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.866 0 7 1.79 7 4v2H5v-2c0-2.21 3.134-4 7-4zm0-10a4 4 0 110 8 4 4 0 010-8z" />
        </svg>
        <span class="text-xs">Profil</span>
    </a>
</nav>


<!-- SCRIPT -->
<script>
const sectionRiwayat = document.getElementById('sectionRiwayat');
const sectionAbsen = document.getElementById('sectionAbsen');
const btnAbsen = document.getElementById('btnAbsen');
const btnKembali = document.getElementById('btnKembali');
const btnKirim = document.getElementById('btnKirim');
const jarakLokasi = document.getElementById('jarakLokasi');

let map, userMarker;


// ================== SETTING LOKASI KANTOR ==================
const kantorLat  = -6.833528;     // GANTI sesuai lokasi kantor kamu
const kantorLng  = 107.9203758;    // GANTI sesuai lokasi kantor kamu
const radiusMaks = 20;            // Jarak meter

function hitungJarak(lat1, lon1, lat2, lon2){
    const R = 6371e3;
    const φ1 = lat1 * Math.PI/180;
    const φ2 = lat2 * Math.PI/180;
    const Δφ = (lat2-lat1) * Math.PI/180;
    const Δλ = (lon2-lon1) * Math.PI/180;

    const a = Math.sin(Δφ/2)**2 +
              Math.cos(φ1) * Math.cos(φ2) *
              Math.sin(Δλ/2)**2;

    return R * Math.atan2(Math.sqrt(a), Math.sqrt(1-a))*2;
}


// Buka tampilan absen
btnAbsen.addEventListener('click', () => {
    sectionRiwayat.classList.add('hidden');
    sectionAbsen.classList.remove('hidden');
    setTimeout(() => sectionAbsen.classList.add('opacity-100'), 10);
    initMap();
});

// Tombol kembali
btnKembali.addEventListener('click', () => {
    sectionAbsen.classList.remove('opacity-100');
    setTimeout(() => {
        sectionAbsen.classList.add('hidden');
        sectionRiwayat.classList.remove('hidden');
    }, 200);
});

// Leaflet Map
function initMap() {
    if (!map) {
        map = L.map('map').setView([kantorLat, kantorLng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);

        // Tambah marker lokasi kantor
        L.circle([kantorLat, kantorLng], {
            radius: radiusMaks,
            color: "red"
        }).addTo(map).bindPopup("Radius Absen");
    }

    navigator.geolocation.getCurrentPosition(pos => {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;

        if (userMarker) userMarker.remove();
        userMarker = L.marker([lat, lng]).addTo(map).bindPopup("Lokasi Anda").openPopup();

        map.setView([lat, lng], 17);

        const jarak = hitungJarak(lat, lng, kantorLat, kantorLng);

        if(jarak <= radiusMaks){
            jarakLokasi.innerText = `✅ Dalam Radius (${Math.round(jarak)} m)`;
            btnKirim.disabled = false;
            btnKirim.classList.remove("opacity-50");
        } else {
            jarakLokasi.innerText = `❌ Di Luar Radius (${Math.round(jarak)} m)`;
            btnKirim.disabled = true;
            btnKirim.classList.add("opacity-50");
        }
    });
}


// ===== FACE ID SIMPLE (capture foto saja) =====
const videoFace = document.getElementById('videoFace');
let faceVerified = false;
let capturedImage = null;

navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => videoFace.srcObject = stream);

videoFace.addEventListener('play', ()=>{
    faceVerified = true;
    document.getElementById('statusFace').innerHTML = "Kamera Aktif ✅";
});

async function ambilFoto(){
    let canvas = document.createElement('canvas');
    canvas.width = 200;
    canvas.height = 150;
    let ctx = canvas.getContext('2d');
    ctx.drawImage(videoFace,0,0,200,150);
    capturedImage = canvas.toDataURL("image/png");
}


// Tombol kirim absen
btnKirim.addEventListener('click', async () => {
    if(!faceVerified){
        alert("❌ Wajah tidak terverifikasi");
        return;
    }

    await ambilFoto();

    try{
        await axios.post("{{ route('karyawan.absen.store') }}",{
            foto: capturedImage
        });
        alert("✅ Absen berhasil tersimpan");
        location.reload();
    } catch(e){
        alert("Gagal menyimpan absen");
    }
});
</script>


</body>
</html>
