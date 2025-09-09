
<main class="max-w-4xl mx-auto p-4">
    <!-- Step 1: Collect email & category -->
    <section id="step-collect" class="card bg-white p-5 rounded-2xl mt-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-semibold">Book your ticket</h2>
          <p class="text-sm text-gray-500">Enter your email and ticket category to start. You'll be redirected to payment.</p>
        </div>
        <div class="text-sm text-gray-500">Mobile responsive • Bank transfer supported</div>
      </div>

      <form id="emailCategoryForm" class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div class="sm:col-span-2">
          <label class="block text-xs font-medium text-gray-600">Email</label>
          <input id="email" type="email" required class="mt-1 w-full rounded-lg border-gray-200 shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-indigo-300" placeholder="you@example.com">
        </div>

        <div>
          <label class="block text-xs font-medium text-gray-600">Category</label>
          <select id="category" required class="mt-1 w-full rounded-lg border-gray-200 p-3">
            <option value="Worker">Worker</option>
            <option value="Undergraduate">Undergraduate</option>
            <option value="School Leaver">School Leaver</option>
            <option value="Secondary School Student">Secondary School Student</option>
          </select>
        </div>

        <div class="sm:col-span-3 flex gap-2 mt-2">
          <button type="submit" class="ml-auto inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-lg">Proceed to Payment</button>
        </div>
      </form>
    </section>

    <!-- Step 2: Payment page -->
    <section id="step-payment" class="hidden card bg-white p-5 rounded-2xl mt-6">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-semibold">Bank Transfer Payment</h2>
          <p class="text-sm text-gray-500">Transfer to the account below and we'll detect payment status automatically.</p>
        </div>
        <div class="text-sm text-gray-600">Reference: <span id="payRef" class="font-medium"></span></div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
        <div class="p-4 rounded-lg border border-gray-100">
          <h3 class="text-sm font-semibold text-gray-700">Account details</h3>
          <p class="mt-2 text-sm text-gray-600">Bank: Access Bank</p>
          <p class="text-sm text-gray-600">Account name: PHFO Camp</p>
          <p class="text-sm text-gray-600">Account number: 1234567890</p>
          <p class="mt-2 text-sm text-gray-500">Amount: <span id="amountLabel" class="font-medium">₦0</span></p>
        </div>

        <div class="p-4 rounded-lg border border-gray-100 flex flex-col justify-between">
          <div>
            <h3 class="text-sm font-semibold text-gray-700">Payment status</h3>
            <p class="mt-2 text-sm text-gray-600" id="paymentStatus">Waiting for payment...</p>
          </div>
          <div class="flex gap-2 mt-4">
            <button id="startPollBtn" class="px-4 py-2 bg-emerald-500 text-white rounded-lg">Start Polling</button>
            <button id="simulatePaymentBtn" class="px-4 py-2 bg-yellow-400 text-black rounded-lg">Simulate Paid (Demo)</button>
            <button id="backBtn1" class="ml-auto px-4 py-2 bg-gray-200 rounded-lg">Back</button>
          </div>
        </div>
      </div>

      <p class="text-xs text-gray-500 mt-3">Note: Replace polling endpoint in the script with your server's /api/payment/status?ref=REF to check real payment status. See integration notes in the code comments.</p>
    </section>

    <!-- Step 3: Registration form (post-payment) -->
    <section id="step-register" class="hidden card bg-white p-5 rounded-2xl mt-6">
      <h2 class="text-xl font-semibold">Complete Registration</h2>
      <p class="text-sm text-gray-500">Provide the details below to generate your event ID/receipt.</p>

      <form id="registrationForm" class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="sm:col-span-2">
          <label class="text-xs font-medium text-gray-600">Full name</label>
          <input id="fullname" required class="mt-1 w-full rounded-lg border-gray-200 p-3" />
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">Local Branch</label>
          <select id="branch" required class="mt-1 w-full rounded-lg border-gray-200 p-3">
            <option>Remo</option>
            <option>Ijebu</option>
            <option>Egba</option>
            <option>Yewa</option>
            <option>Ado-Odo/Ota</option>
          </select>
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">Phone</label>
          <input id="phone" required class="mt-1 w-full rounded-lg border-gray-200 p-3" placeholder="0803xxxxxxx" />
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">School / Institution</label>
          <input id="school" class="mt-1 w-full rounded-lg border-gray-200 p-3" />
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">Level / Class</label>
          <input id="level" class="mt-1 w-full rounded-lg border-gray-200 p-3" />
        </div>

        <div class="sm:col-span-2 flex gap-2 mt-2">
          <button type="submit" class="ml-auto px-5 py-3 bg-indigo-600 text-white rounded-lg">Complete Registration</button>
        </div>
      </form>
    </section>

    <!-- Step 4: Ticket / ID card -->
    <section id="step-ticket" class="hidden card bg-white p-5 rounded-2xl mt-6">
      <div class="flex items-start gap-4">
        <div class="w-36 h-48 p-3 rounded-lg blur-bg text-white flex flex-col justify-between">
          <div>
            <h3 class="text-lg font-bold">PHFO Camp</h3>
            <p class="text-xs">Event ID</p>
            <p id="ticketId" class="text-2xl font-semibold mt-2">#0000</p>
          </div>
          <div class="text-xs">Present this at check-in</div>
        </div>

        <div class="flex-1">
          <h3 class="text-xl font-semibold" id="ticketName">Full Name</h3>
          <p class="text-sm text-gray-500" id="ticketMeta">Branch • Category • Phone</p>

          <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="p-3 rounded-lg border border-gray-100">
              <h4 class="text-sm font-semibold">Receipt</h4>
              <div class="mt-2 text-sm text-gray-600">
                <p>Reference: <span id="ticketRef"></span></p>
                <p>Amount: <span id="ticketAmount"></span></p>
                <p>Paid: <span id="ticketPaidOn"></span></p>
              </div>
            </div>

            <div class="p-3 rounded-lg border border-gray-100 flex flex-col items-center justify-center">
              <svg id="qrSvg" width="110" height="110" viewBox="0 0 140 140" xmlns="http://www.w3.org/2000/svg">
                <rect width="140" height="140" fill="#111827" rx="8"></rect>
                <text x="70" y="75" font-size="10" fill="#fff" text-anchor="middle">PHFO</text>
              </svg>
              <p class="text-xs text-gray-500 mt-2">Show this at the gate</p>
            </div>
          </div>

          <div class="mt-4 flex gap-2">
            <button id="printBtn" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Print / Save</button>
            <button id="downloadBtn" class="px-4 py-2 bg-gray-100 rounded-lg">Download (PNG)</button>
            <button id="startOverBtn" class="ml-auto px-4 py-2 bg-red-50 rounded-lg">Start Over</button>
          </div>
        </div>
      </div>
    </section>

  </main>
