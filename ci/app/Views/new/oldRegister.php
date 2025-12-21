<main class="max-w-4xl mx-auto p-4">
    
    <section id="step-collect" class="card bg-white p-5 rounded-2xl mt-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-semibold">Book your ticket</h2>
          <p class="text-sm text-gray-500">Enter your email and ticket category to start. You'll be redirected to payment.</p>
        </div>
        <div class="text-sm text-gray-500">Mobile responsive • Bank transfer supported</div>
      </div>

      <form id="emailCategoryForm" class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3" action="<?=base_url('register')?>" method="POST">
        <div class="sm:col-span-2">
          <label class="block text-xs font-medium text-gray-600">Email</label>
          <input id="email" type="email" required class="mt-1 w-full rounded-lg border-gray-200 shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-indigo-300" placeholder="you@example.com" name="email">
        </div>

        <div>
          <label class="block text-xs font-medium text-gray-600">Category</label>
          <select id="category" required class="mt-1 w-full rounded-lg border-gray-200 p-3" name="category">
            <option value="">Select a Category</option>
            <option value="Worker|15100">Worker</option>
            <option value="Undergraduate|12101">Undergraduate</option>
            <option value="SchoolLeaver|12100">School Leaver</option>
            <option value="SSS|10099">Secondary School Student</option>
            <option value="TFL|6000">TFL</option>
            <!-- <option value="test|100">Test</option> -->
          </select>
        </div>

        <div class="sm:col-span-3 flex gap-2 mt-2">
          <button type="submit" class="ml-auto inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-lg">Proceed to Payment</button>
        </div>
      </form>
    </section>
    <section class="mt-6 text-center">
      <p class="text-sm text-gray-500">Need to register multiple attendees?</p>
      <a href="<?= base_url('bulkregister') ?>" class="inline-flex items-center gap-2 mt-2 px-5 py-3 bg-indigo-50 text-indigo-700 rounded-lg border border-indigo-100 hover:bg-indigo-100">
        Register multiple
      </a>
    </section>

</main>