<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PMC Camp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .gradient-hero{background:radial-gradient(1200px 600px at 10% -10%,rgba(79,70,229,.15),transparent 60%),radial-gradient(900px 500px at 100% 0,rgba(6,182,212,.18),transparent 55%),linear-gradient(180deg,#ffffff, #f8fafc);} 
    .glass{backdrop-filter: blur(8px); background: rgba(255,255,255,0.7);} 
  </style>
</head>
<body class="text-slate-800 bg-white">
  <!-- NAVBAR -->
  <header class="sticky top-0 z-30 bg-white/70 backdrop-blur border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <a href="#" class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-cyan-500 text-white font-bold grid place-items-center">PMC</div>
          <div class="leading-tight">
            <div class="font-semibold">PMC Ogun</div>
            <div class="text-xs text-slate-500 -mt-1">Pure Heart Modelling Camp</div>
          </div>
        </a>
        <nav class="hidden md:flex items-center gap-6 text-sm">
          <a href="#about" class="hover:text-indigo-600">About</a>
          <a href="#highlights" class="hover:text-indigo-600">Highlights</a>
          <a href="#faq" class="hover:text-indigo-600">FAQ</a>
          <a href="<?=base_url('register')?>" class="px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Register</a>
          <a href="/officials" class="px-3 py-2 rounded-lg bg-cyan-600 text-white hover:bg-cyan-700">Camp Officials</a>
          <a href="/status" class="px-3 py-2 rounded-lg border border-slate-300 hover:border-slate-400">Status</a>
        </nav>
        <button id="menuBtn" class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-slate-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>
    </div>
    <!-- Mobile menu -->
    <div id="mobileMenu" class="md:hidden hidden border-t border-slate-200">
      <div class="px-4 py-3 grid gap-2 text-sm">
        <a href="#about" class="px-3 py-2 rounded-lg hover:bg-slate-100">About</a>
        <a href="#highlights" class="px-3 py-2 rounded-lg hover:bg-slate-100">Highlights</a>
        <a href="#faq" class="px-3 py-2 rounded-lg hover:bg-slate-100">FAQ</a>
        <a href="<?=base_url('register')?>" class="px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Register</a>
        <a href="/officials" class="px-3 py-2 rounded-lg bg-cyan-600 text-white hover:bg-cyan-700">Camp Officials</a>
        <a href="/status" class="px-3 py-2 rounded-lg border border-slate-300 hover:bg-slate-100">Status</a>
      </div>
    </div>
  </header>
