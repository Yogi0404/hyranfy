@extends('layouts.admin-layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="relative flex flex-col items-center justify-center min-h-[85vh] overflow-hidden text-white rounded-3xl 
    bg-gradient-to-b from-[#020617] via-[#001428] to-[#000810] shadow-inner">

  {{-- Background efek partikel + cahaya --}}
  <div class="absolute inset-0">
    {{-- Gradasi halus berlapis --}}
    <div class="absolute inset-0 bg-gradient-to-br from-black via-[#041b3b] to-[#01070f] opacity-95"></div>
    
    {{-- Cahaya bulat besar di belakang (glow biru) --}}
    <div class="absolute top-1/3 left-1/3 w-[500px] h-[500px] bg-blue-600/20 blur-[180px] rounded-full animate-pulse-slow"></div>
    
    {{-- Partikel kecil yang bergerak --}}
    <canvas id="particleCanvas" class="absolute inset-0 w-full h-full"></canvas>
    
    {{-- Cahaya bawah --}}
    <div class="absolute bottom-0 w-full h-40 bg-gradient-to-t from-blue-900/40 to-transparent blur-2xl"></div>
  </div>

  {{-- Konten utama --}}
  <div class="relative z-10 text-center px-6">
    <h1 class="text-5xl font-extrabold tracking-wide bg-gradient-to-r from-blue-300 via-blue-100 to-white 
        text-transparent bg-clip-text drop-shadow-lg animate-slideIn">
     HAYRANFY DASHBOARD 💼
    </h1>

    {{-- Tagline utama --}}
    <p class="mt-4 text-lg italic text-blue-200 animate-fadeIn-slow max-w-2xl mx-auto">
      “Hadir, Absensi, dan Yakin Raih Akurasi Nyata untuk Fleksibilitas Karyawan.”
    </p>

    {{-- Teks motivasi berganti --}}
    <div class="mt-6 text-lg font-medium text-blue-100 animate-fadeIn">
      <span id="text-rotator" class="transition-all duration-700"></span>
    </div>

    <div class="mt-8 w-48 h-[3px] bg-gradient-to-r from-blue-400 via-cyan-300 to-blue-600 rounded-full animate-glow"></div>
  </div>
</div>

<style>
@keyframes pulse-slow {
  0%, 100% { opacity: 0.8; transform: scale(1); }
  50% { opacity: 1; transform: scale(1.05); }
}
@keyframes fadeIn { from { opacity: 0; transform: translateY(15px);} to { opacity: 1; transform: translateY(0);} }
@keyframes fadeInSlow { from { opacity: 0; transform: translateY(30px);} to { opacity: 1; transform: translateY(0);} }
@keyframes slideIn { from { opacity: 0; transform: translateY(-20px) scale(0.95);} to { opacity: 1; transform: translateY(0) scale(1);} }
@keyframes glow { 0%,100%{opacity:.6;box-shadow:0 0 20px rgba(147,197,253,.3);}50%{opacity:1;box-shadow:0 0 40px rgba(147,197,253,.6);} }
.animate-fadeIn { animation: fadeIn 1.3s ease-out forwards; }
.animate-fadeIn-slow { animation: fadeInSlow 1.8s ease-out forwards; }
.animate-slideIn { animation: slideIn 1.2s ease-out forwards; }
.animate-pulse-slow { animation: pulse-slow 6s ease-in-out infinite; }
.animate-glow { animation: glow 3s ease-in-out infinite; }
</style>

<script>
  // Animasi teks rotator
  const texts = [
    "Selamat Datang di Hairanfai 👋",
    "Bangun Produktivitas, Raih Kinerja Terbaik 💪",
    "Ciptakan Disiplin, Wujudkan Akurasi Absensi 📊",
    "Manajemen Waktu Adalah Kunci Kesuksesan ⏰"
  ];
  let index = 0;
  const rotator = document.getElementById("text-rotator");
  function changeText() {
    rotator.style.opacity = 0;
    setTimeout(() => {
      rotator.textContent = texts[index];
      rotator.style.opacity = 1;
      index = (index + 1) % texts.length;
    }, 400);
  }
  changeText();
  setInterval(changeText, 4000);

  // Efek partikel bergerak di background
  const canvas = document.getElementById("particleCanvas");
  const ctx = canvas.getContext("2d");
  let particles = [];
  const particleCount = 40;

  function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  for (let i = 0; i < particleCount; i++) {
    particles.push({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      r: Math.random() * 2 + 1,
      dx: (Math.random() - 0.5) * 0.6,
      dy: (Math.random() - 0.5) * 0.6
    });
  }

  function drawParticles() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = "rgba(100,150,255,0.3)";
    for (let p of particles) {
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fill();
      p.x += p.dx;
      p.y += p.dy;
      if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
      if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
    }
    requestAnimationFrame(drawParticles);
  }
  drawParticles();
</script>
@endsection
