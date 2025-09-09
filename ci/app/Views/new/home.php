
  <!-- HERO -->
  <section class="gradient-hero">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
      <div class="grid lg:grid-cols-2 gap-10 items-center">
        <div>
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs mb-4">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Registration now open
          </div>
          <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900">Grow, Connect & Serve at <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-cyan-500">PMC Camp</span></h1>
          <p class="mt-4 text-slate-600 max-w-xl">Join campers from across the state for an unforgettable experience of learning, worship, mentorship, and community-building.</p>
          <div class="mt-6 flex flex-wrap gap-3">
            <a href="<?=base_url('register')?>" class="px-5 py-3 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 shadow">Register</a>
            <a href="/officials" class="px-5 py-3 rounded-xl bg-cyan-600 text-white hover:bg-cyan-700 shadow">Camp Official Registration</a>
            <a href="/status" class="px-5 py-3 rounded-xl border border-slate-300 hover:border-slate-400">Check Status</a>
          </div>
          <div class="mt-6 flex items-center gap-4 text-sm text-slate-500">
            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-indigo-600"></span> Secure ticketing</div>
            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-cyan-500"></span> ID card on completion</div>
            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Mobile friendly</div>
          </div>
        </div>
        <div class="relative">
          <div class="absolute -inset-6 -z-10 blur-2xl opacity-50 bg-gradient-to-br from-indigo-200 to-cyan-200 rounded-3xl"></div>
          <div class="glass rounded-3xl p-6 border border-white/60 shadow-xl">
            <div class="grid grid-cols-2 gap-4">
              <div class="p-4 rounded-2xl bg-white shadow">
                <div class="text-xs text-slate-500">Dates</div>
                <div class="font-semibold">To be announced</div>
              </div>
              <div class="p-4 rounded-2xl bg-white shadow">
                <div class="text-xs text-slate-500">Venue</div>
                <div class="font-semibold">Coming soon</div>
              </div>
              <div class="p-4 rounded-2xl bg-white shadow">
                <div class="text-xs text-slate-500">Fee</div>
                <div class="font-semibold">Varies by category</div>
              </div>
              <div class="p-4 rounded-2xl bg-white shadow">
                <div class="text-xs text-slate-500">Support</div>
                <div class="font-semibold">help@pmc.camp</div>
              </div>
            </div>
            <div class="mt-4 text-xs text-slate-500">You can update the boxes above dynamically from your backend.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- HIGHLIGHTS -->
  <section id="highlights" class="py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h2 class="text-2xl sm:text-3xl font-bold">What to Expect</h2>
        <p class="mt-2 text-slate-600">Built for youths, workers and officials — simple and fast registration.</p>
      </div>
      <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
          <div class="w-10 h-10 rounded-lg bg-indigo-600 text-white grid place-items-center mb-3">1</div>
          <div class="font-semibold">Online Registration</div>
          <p class="text-sm text-slate-600 mt-1">Register by email and category in minutes. Supports workers, undergraduates, school leavers and secondary students.</p>
        </div>
        <div class="p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
          <div class="w-10 h-10 rounded-lg bg-cyan-600 text-white grid place-items-center mb-3">2</div>
          <div class="font-semibold">Bank Transfer Payments</div>
          <p class="text-sm text-slate-600 mt-1">Automated status checks with secure references. Redirects back to finish registration.</p>
        </div>
        <div class="p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
          <div class="w-10 h-10 rounded-lg bg-emerald-600 text-white grid place-items-center mb-3">3</div>
          <div class="font-semibold">Instant ID Card</div>
          <p class="text-sm text-slate-600 mt-1">Generate a scannable badge and receipt instantly — ready to print or save as PDF.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about" class="py-14 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-10 items-center">
        <div>
          <h3 class="text-2xl font-bold">About PMC Camp</h3>
          <p class="mt-3 text-slate-600">PMC Camp brings youths and workers together for immersive learning, mentorship, worship and service. Our digital flow keeps things simple so you can focus on the experience.</p>
          <ul class="mt-4 space-y-2 text-slate-700">
            <li class="flex items-start gap-2"><span class="mt-1 w-2 h-2 rounded-full bg-indigo-600"></span> Streamlined ticketing and official onboarding</li>
            <li class="flex items-start gap-2"><span class="mt-1 w-2 h-2 rounded-full bg-cyan-500"></span> Category-based pricing & reporting</li>
            <li class="flex items-start gap-2"><span class="mt-1 w-2 h-2 rounded-full bg-emerald-500"></span> Mobile-first, offline-friendly check-in tools</li>
          </ul>
          <div class="mt-6 flex gap-3">
            <a href="<?=base_url('register')?>" class="px-5 py-3 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700">Register Now</a>
            <a href="/officials" class="px-5 py-3 rounded-xl bg-cyan-600 text-white hover:bg-cyan-700">Officials Portal</a>
          </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
          <div class="p-5 rounded-2xl bg-white shadow border border-slate-200">
            <div class="text-xs text-slate-500">Local Branches</div>
            <div class="text-lg font-semibold">Remo • Ijebu • Egba • Yewa • Ado‑Odo/Ota</div>
          </div>
          <div class="p-5 rounded-2xl bg-white shadow border border-slate-200">
            <div class="text-xs text-slate-500">Categories</div>
            <div class="text-lg font-semibold">Worker • Undergraduate • School Leaver • SSS</div>
          </div>
          <div class="p-5 rounded-2xl bg-white shadow border border-slate-200">
            <div class="text-xs text-slate-500">Support</div>
            <div class="text-lg font-semibold">+234 xxx xxx xxxx</div>
          </div>
          <div class="p-5 rounded-2xl bg-white shadow border border-slate-200">
            <div class="text-xs text-slate-500">Email</div>
            <div class="text-lg font-semibold">help@pmc.camp</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="py-14">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <h3 class="text-2xl font-bold text-center">Frequently Asked Questions</h3>
      <div class="mt-8 divide-y divide-slate-200 rounded-2xl border border-slate-200 bg-white">
        <details class="group p-5">
          <summary class="flex cursor-pointer items-center justify-between font-medium">How do I register?<span class="transition group-open:rotate-180">▾</span></summary>
          <p class="mt-2 text-slate-600 text-sm">Click <a href="<?=base_url('register')?>" class="text-indigo-600 underline">Register</a>, enter your email and category, then complete payment via bank transfer. You'll be redirected to finish your profile and get your ID card.</p>
        </details>
        <details class="group p-5">
          <summary class="flex cursor-pointer items-center justify-between font-medium">How do officials register?<span class="transition group-open:rotate-180">▾</span></summary>
          <p class="mt-2 text-slate-600 text-sm">Use the <a href="/officials" class="text-cyan-600 underline">Camp Officials</a> portal to onboard with your role and unit.</p>
        </details>
        <details class="group p-5">
          <summary class="flex cursor-pointer items-center justify-between font-medium">Where can I check my status?<span class="transition group-open:rotate-180">▾</span></summary>
          <p class="mt-2 text-slate-600 text-sm">Visit the <a href="/status" class="text-slate-800 underline">Status</a> page and enter your reference to see payment and registration progress.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-sm text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-4">
      <div>© <span id="year"></span> PMC Camp. All rights reserved.</div>
      <div class="flex items-center gap-3">
        <a href="mailto:help@pmc.camp" class="hover:text-slate-700">help@pmc.camp</a>
        <span>•</span>
        <a href="#" class="hover:text-slate-700">Privacy</a>
        <a href="#" class="hover:text-slate-700">Terms</a>
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu toggle
    document.getElementById('menuBtn').addEventListener('click', ()=>{
      const m = document.getElementById('mobileMenu');
      m.classList.toggle('hidden');
    });
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>
</html>