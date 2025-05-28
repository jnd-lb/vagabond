<?php
include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();
isAdmin();

include('../functions/db.php');
$conn = openDatabaseConnection();
include('../functions/plates-functions.php');
include('../functions/categories-functions.php');

$plates = getAllPlates($conn);
$categories = getAllCategories($conn);
?>

<main class="row dashboard">
  <div class="col-md-3">
    <?php include './sidebar.php'; ?>
  </div>

  <div class="col-md-9">
    <div class="container mt-4">
      <h1 class="fw-bold display-4 text-dark">POS</h1>

      <div class="row">
        <!-- POS Section -->
        <div class="col-md-8">
          <div class="mb-3">
            <label for="tableSelect" class="form-label">Select Table</label>
            <select class="form-select" id="tableSelect">
              <option value="">Choose...</option>
              <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="Table <?= $i ?>">Table <?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>

          <!-- Category Filters -->
          <div class="mb-4">
            <button class="btn btn-outline-dark category-filter" data-category="all">All</button>
            <?php foreach ($categories as $category): ?>
              <button class="btn btn-outline-primary category-filter" data-category="<?= $category['name'] ?>">
                <?= $category['name'] ?>
              </button>
            <?php endforeach; ?>
          </div>

          <!-- Plates -->
          <div class="row" id="plates-container">
            <?php foreach ($plates as $plate): ?>
              <div class="col-md-4 mb-3 plate-card" data-category="<?= $plate['category_name'] ?>">
                <div class="card text-center">
                  <img src="../images/food/<?= $plate['image'] ?>"
                       class="card-img-top rounded-circle mx-auto mt-3"
                       style="width: 80px; height: 80px; object-fit: cover;"
                       alt="<?= $plate['name'] ?>">
                  <div class="card-body">
                    <h6 class="card-title text-dark"><?= $plate['name'] ?></h6>
                    <p class="text-warning fw-bold">$<?= $plate['price'] ?></p>
                    <button class="btn btn-sm btn-primary add-to-cart-btn"
                            data-id="<?= $plate['id'] ?>"
                            data-name="<?= $plate['name'] ?>"
                            data-price="<?= $plate['price'] ?>">
                      Add
                    </button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Cart Section -->
        <div class="col-md-4">
          <h4>Cart</h4>
          <ul class="list-group mb-3" id="cart-list"></ul>
          <h5>Total: $<span id="cart-total">0</span></h5>

          <form method="POST" action="submit-order.php" id="orderForm">
            <input type="hidden" name="table" id="tableInput">
            <input type="hidden" name="cart" id="cartInput">
            <button class="btn btn-success mt-3 w-100" type="submit">Submit Order</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  const cart = {};
  const cartList = document.getElementById('cart-list');
  const cartTotal = document.getElementById('cart-total');
  const tableInput = document.getElementById('tableInput');
  const cartInput = document.getElementById('cartInput');

  function updateCart() {
    cartList.innerHTML = '';
    let total = 0;
    for (const id in cart) {
      const item = cart[id];
      const itemTotal = item.price * item.qty;
      total += itemTotal;
      cartList.innerHTML += `
        <li class="list-group-item d-flex justify-content-between align-items-center">
          ${item.name} x ${item.qty}
          <span>$${itemTotal.toFixed(2)}</span>
        </li>`;
    }
    cartTotal.textContent = total.toFixed(2);
    cartInput.value = JSON.stringify(cart);
    // Update table input value whenever cart updates
    tableInput.value = document.getElementById('tableSelect').value;
  }

  document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.dataset.id;
      const name = button.dataset.name;
      const price = parseFloat(button.dataset.price);
      if (!cart[id]) {
        cart[id] = { name, price, qty: 1 };
      } else {
        cart[id].qty++;
      }
      updateCart();
    });
  });

  document.querySelectorAll('.category-filter').forEach(button => {
    button.addEventListener('click', () => {
      const category = button.dataset.category;
      document.querySelectorAll('.plate-card').forEach(card => {
        const match = category === 'all' || card.dataset.category === category;
        card.style.display = match ? 'block' : 'none';
      });
    });
  });

  // Update tableInput when table selection changes
  document.getElementById('tableSelect').addEventListener('change', () => {
    tableInput.value = document.getElementById('tableSelect').value;
  });

  document.getElementById('orderForm').addEventListener('submit', e => {
    if (!tableInput.value || Object.keys(cart).length === 0) {
      e.preventDefault();
      alert("Please select a table and add at least one item.");
    }
  });
</script>

<?php include './admin-footer.php'; ?>
