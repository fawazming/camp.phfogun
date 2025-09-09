
<footer class="max-w-4xl mx-auto p-4 text-center text-sm text-gray-500">© PHFO Camp</footer>

<script>
  // ----------------------
  // CONFIG
  // ----------------------
  // Replace these endpoints with your backend implementation
  const PAYMENT_STATUS_ENDPOINT = '/api/payment/status?ref='; // GET -> { status: 'pending'|'success' }
  const REGISTER_ENDPOINT = '/api/register'; // POST -> { success: true, ticketId }

  // Demo mode: toggles simulated backend responses.
  // Set to false in production.
  const DEMO = true;

  // prices (example) — customise per category
  const PRICES = {
    'Worker': 2000,
    'Undergraduate': 1500,
    'School Leaver': 1000,
    'Secondary School Student': 500
  };

  // ----------------------
  // UI helpers & state
  // ----------------------
  const qs = sel => document.querySelector(sel);
  const qsa = sel => document.querySelectorAll(sel);

  const state = {
    email: null,
    category: null,
    reference: null,
    amount: 0,
    paymentInterval: null,
    paid: false
  };

  function show(sectionId) {
    ['#step-collect','#step-payment','#step-register','#step-ticket'].forEach(id => {
      const el = qs(id);
      if (!el) return;
      if (id === sectionId) el.classList.remove('hidden'); else el.classList.add('hidden');
    });
    window.scrollTo({top:0,behavior:'smooth'});
  }

  // ----------------------
  // Step 1: submit email & category
  // ----------------------
  document.getElementById('emailCategoryForm').addEventListener('submit', (e)=>{
    e.preventDefault();
    const email = qs('#email').value.trim();
    const category = qs('#category').value;
    if (!email) return alert('Please enter a valid email');

    state.email = email;
    state.category = category;
    state.amount = PRICES[category] || 0;
    state.reference = 'PHFO' + Date.now().toString().slice(-6);

    qs('#amountLabel').textContent = '₦' + state.amount.toLocaleString();
    qs('#payRef').textContent = state.reference;
    show('#step-payment');
  });

  // ----------------------
  // Step 2: payment polling
  // ----------------------
  function checkPaymentStatus(ref) {
    // Production: fetch(`${PAYMENT_STATUS_ENDPOINT}${encodeURIComponent(ref)}`)
    //   .then(r=>r.json())
    //   .then(data=>{ /* handle */ });

    if (DEMO) {
      // In demo mode we'll auto succeed after 8 seconds
      return new Promise(resolve=>{
        const started = Date.now();
        // simulate quick poll: succeed after 8s
        const now = Date.now();
        const elapsed = now - window._demoPaymentStart;
        if (elapsed > 8000) resolve({status: 'success', paidAt: new Date().toISOString()});
        else resolve({status: 'pending'});
      });
    }

    return fetch(`${PAYMENT_STATUS_ENDPOINT}${encodeURIComponent(ref)}`, {cache:'no-store'})
      .then(r=>r.json())
      .catch(()=>({status:'pending'}));
  }

  qs('#startPollBtn').addEventListener('click', ()=>{
    if (!state.reference) return alert('Missing reference');
    if (state.paymentInterval) return;
    qs('#paymentStatus').textContent = 'Polling payment status...';
    window._demoPaymentStart = Date.now();

    state.paymentInterval = setInterval(async ()=>{
      const res = await checkPaymentStatus(state.reference);
      if (res.status === 'success') {
        clearInterval(state.paymentInterval); state.paymentInterval = null; state.paid = true;
        qs('#paymentStatus').textContent = 'Payment confirmed — continuing registration';
        setTimeout(()=> show('#step-register'), 700);
      } else {
        qs('#paymentStatus').textContent = 'Waiting for payment... (still pending)';
      }
    }, 2500);
  });

  qs('#simulatePaymentBtn').addEventListener('click', ()=>{
    // For demo only: instantly mark as paid.
    if (state.paymentInterval) clearInterval(state.paymentInterval);
    state.paid = true;
    qs('#paymentStatus').textContent = 'Payment simulated as successful.';
    setTimeout(()=> show('#step-register'), 600);
  });

  qs('#backBtn1').addEventListener('click', ()=> show('#step-collect'));

  // ----------------------
  // Step 3: registration
  // ----------------------
  document.getElementById('registrationForm').addEventListener('submit', async (e)=>{
    e.preventDefault();
    const payload = {
      email: state.email,
      category: state.category,
      reference: state.reference,
      amount: state.amount,
      fullname: qs('#fullname').value.trim(),
      branch: qs('#branch').value,
      phone: qs('#phone').value.trim(),
      school: qs('#school').value.trim(),
      level: qs('#level').value.trim(),
    };

    // Basic front-end validation
    if (!payload.fullname || !payload.phone) return alert('Please provide fullname and phone number');

    // In production do a POST to your server here and receive a ticketId & timestamp.
    if (DEMO) {
      const ticketId = 'TCK' + Math.floor(Math.random()*900000 + 100000);
      const paidOn = new Date().toLocaleString();
      renderTicket({ ticketId, paidOn, payload });
      show('#step-ticket');
      return;
    }

    try {
      const res = await fetch(REGISTER_ENDPOINT, {
        method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify(payload)
      });
      const json = await res.json();
      if (json.success) {
        renderTicket({ ticketId: json.ticketId, paidOn: json.paidOn || new Date().toISOString(), payload });
        show('#step-ticket');
      } else alert('Registration failed');
    } catch (err) {
      console.error(err); alert('Registration failed — network error');
    }
  });

  // ----------------------
  // Step 4: render ticket and actions
  // ----------------------
  function renderTicket({ ticketId, paidOn, payload }){
    qs('#ticketId').textContent = ticketId;
    qs('#ticketName').textContent = payload.fullname;
    qs('#ticketMeta').textContent = `${payload.branch} • ${payload.category} • ${payload.phone}`;
    qs('#ticketRef').textContent = payload.reference;
    qs('#ticketAmount').textContent = '₦' + (payload.amount || 0).toLocaleString();
    qs('#ticketPaidOn').textContent = new Date(paidOn).toLocaleString();

    // Update a simple svg QR placeholder with key info
    const svg = qs('#qrSvg');
    const txt = `ID:${ticketId}\nName:${payload.fullname}\nRef:${payload.reference}`;
    // For simplicity we replace innerText on svg text node.
    const t = document.createElementNS('http://www.w3.org/2000/svg','text');
    t.setAttribute('x', '70'); t.setAttribute('y','75'); t.setAttribute('font-size','8'); t.setAttribute('fill','#fff'); t.setAttribute('text-anchor','middle');
    t.textContent = ticketId;
    while (svg.firstChild) svg.removeChild(svg.firstChild);
    const bg = document.createElementNS('http://www.w3.org/2000/svg','rect');
    bg.setAttribute('width','140'); bg.setAttribute('height','140'); bg.setAttribute('fill','#111827'); bg.setAttribute('rx','8');
    svg.appendChild(bg); svg.appendChild(t);

    // store to local storage for convenience
    localStorage.setItem('lastTicket', JSON.stringify({ticketId, payload, paidOn}));
  }

  qs('#printBtn').addEventListener('click', ()=> window.print());
  qs('#startOverBtn').addEventListener('click', ()=> location.reload());

  // NOTE: Download as PNG requires html2canvas or server side rendering. For now we fallback to print.
  qs('#downloadBtn').addEventListener('click', ()=> alert('Use Print → Save as PDF, or implement a server endpoint/html2canvas for PNG export.'));

  // Pre-fill email if a previous session exists
  window.addEventListener('load', ()=>{
    const last = JSON.parse(localStorage.getItem('lastTicket')||'null');
    if (last && confirm('Load last registration?')) {
      state.email = last.payload?.email || '';
      if (state.email) qs('#email').value = state.email;
    }
  });

</script>
</body>
</html>