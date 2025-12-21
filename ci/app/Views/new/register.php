<main class="max-w-4xl mx-auto p-4">
    
    <section id="step-collect" class="card bg-white p-5 rounded-2xl mt-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-semibold">Book your ticket</h2>
          <p class="text-sm text-gray-500">Enter your email and ticket category to start. You'll be redirected to payment.</p>
        </div>
        <div class="text-sm text-gray-500">Mobile responsive • Bank transfer supported</div>
      </div>

      <form id="emailCategoryForm" class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3" action="<?=base_url('bregister')?>" method="POST">
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
            <!-- <option value="test|100">Test10</option>
            <option value="test|50">Test5</option>
            <option value="test|20">Test2</option>
            <option value="test|10">Test1</option> -->
          </select>
        </div>
        
        <div class="sm:col-span-3">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-medium text-gray-600">Quantity</label>
              <input id="quantity" type="number" min="1" value="1" class="mt-1 w-full rounded-lg border-gray-200 shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            </div>
            <button type="button" id="addToCart" class="mt-6 px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Add to Cart</button>
          </div>
        </div>

        <div class="sm:col-span-3 mt-6">
          <div id="cartContainer" class="bg-gray-50 rounded-lg p-4 min-h-20">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Cart Items</h3>
            <div id="cartItems" class="space-y-2 max-h-48 overflow-y-auto"></div>
            <div class="mt-4 pt-4 border-t border-gray-200">
              <div class="flex justify-between items-center text-lg font-semibold text-gray-800">
                <span>Total:</span>
                <span id="cartTotal">₦0</span>
              </div>
            </div>
            <input type="hidden" id="bulk" name="bulk" value="">
          </div>
        </div>

        <script>
        const cart = [];
        const addBtn = document.getElementById('addToCart');
        const categorySelect = document.getElementById('category');
        const quantityInput = document.getElementById('quantity');
        const cartItemsDiv = document.getElementById('cartItems');
        const cartTotalSpan = document.getElementById('cartTotal');
        const bulkInput = document.getElementById('bulk');

        addBtn.addEventListener('click', () => {
          const [catName, price] = categorySelect.value.split('|');
          const qty = parseInt(quantityInput.value);
          
          if (!categorySelect.value) return alert('Select a category');
          
          const item = { catName, price: parseInt(price), qty };
          cart.push(item);
          updateCart();
          quantityInput.value = 1;
        });

        function updateCart() {
          cartItemsDiv.innerHTML = cart.map((item, idx) => `
            <div class="flex justify-between items-center bg-white p-3 rounded-lg shadow-sm hover:shadow-md transition animate-fadeIn">
              <div class="flex-1">
                <p class="text-sm font-medium text-gray-700">${item.catName}</p>
                <p class="text-xs text-gray-500">₦${item.price} × ${item.qty}</p>
              </div>
              <p class="font-semibold text-indigo-600">₦${item.price * item.qty}</p>
              <button type="button" onclick="removeItem(${idx})" class="ml-2 text-red-500 hover:text-red-700 text-sm">Remove</button>
            </div>
          `).join('');
          
          const total = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
          cartTotalSpan.textContent = `₦${total}`;
          bulkInput.value = JSON.stringify(cart);
        }

        function removeItem(idx) {
          cart.splice(idx, 1);
          updateCart();
        }
        </script>

        <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
        </style>
        <div class="sm:col-span-3 flex gap-2 mt-2">
          <button type="submit" class="ml-auto inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-lg">Proceed to Payment</button>
        </div>
      </form>
    </section>

</main>