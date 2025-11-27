<main class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Bulk Registration</h1>
      <?php
      $email = $data['email'] ?? '';
      $parts = explode('@', $email, 2);
      $left = $parts[0] ?? '';
      $right = $parts[1] ?? '';
      $plusParts = explode('+', $left, 2);
      $seg0 = $plusParts[0] ?? '';
      $result = ($seg0 !== '' && $right !== '') ? $seg0 .'@'. $right : $email;
      ?>
      <p class="text-gray-600">Email: <span class="font-semibold"><?= htmlspecialchars($result) ?></span></p>
      <p class="text-gray-600">Reference: <span class="font-semibold"><?= htmlspecialchars($data['ref']) ?></span></p>
    </div>

    <!-- Tickets Grid -->
    <div class="space-y-6">
      <?php foreach ($data['tickets'] as $index => $ticket): ?>
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
            <div>
              <h2 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($ticket['catName']) ?></h2>
              <p class="text-gray-600 mt-1">Quantity: <span class="font-semibold"><?= $ticket['qty'] ?></span></p>
              <p class="text-gray-600">Price: <span class="font-semibold text-green-600">₦<?= number_format($ticket['price'], 2) ?></span></p>
            </div>
            <!-- <div class="mt-4 sm:mt-0">
              <a href="<?= site_url('registration/complete?category=' . $index . '&ref=' . htmlspecialchars($data['ref'])) ?>" 
                 class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                Start Registration
              </a>
            </div> -->
          </div>

          <!-- Tickets List -->
          <div class="mt-6 border-t pt-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Available Tickets (<?= count($ticket['tickets']) ?>)</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
              <?php foreach ($ticket['tickets'] as $tk): ?>
                <div class="bg-slate-50 border border-slate-200 rounded p-3 text-center">
                  <a target="_blank" href="<?= base_url('reg/' . rawurlencode($data['ref']) . '/' . rawurlencode($tk['id'])) ?>" class="block">
                    <p class="text-sm font-mono font-bold text-gray-900"><?= htmlspecialchars($tk['id']) ?></p>
                    <p class="text-xs text-gray-500 mt-1"><?= $tk['used'] ? '✓ Used' : '○ Unused' ?></p>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</main>