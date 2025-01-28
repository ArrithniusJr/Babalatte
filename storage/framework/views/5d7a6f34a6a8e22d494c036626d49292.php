
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Available Items For Order</title>
    <link rel="shortcut icon" href="gallery/logo.svg" type="image/x-icon" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/items.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="header">
      <h1>
        <img class="d-inline-block" src="gallery/logo.svg" alt="logo" />
        <span class="text-gradient">BabaLatte & Tacos</span>
      </h1>
      <!-- Display user information -->
      <div class="user-info">
        <p>Welcome, <span id="userEmail"></span></p>
      </div>

      <div class="cart-icon" onclick="toggleCart()">
        <i class="fas fa-bag-shopping"></i>
        <span class="cart-count" id="cartCount">0</span>
      </div>
    </div>


        <div class="items-container">
          <!-- Item list remains the same -->
          <div class="item">
            <div
              class="item-img"
              style="background-image: url(gallery/cheese-burger.png)"
            ></div>
            <h3>Cheese Burger</h3>
            <p>$3.88</p>
            <button onclick="addToCart(1, 'Cheese Burger', 3.88)">
              <i class="fas fa-plus"></i>
              Add to Cart
            </button>
          </div>

          <div class="item">
            <div
              class="item-img"
              style="background-image: url(gallery/toffes-cake.png)"
            ></div>
            <h3>Toffe's Cake</h3>
            <p>$4.00</p>
            <button onclick="addToCart(2, 'Toffe Cake', 4.00)">
              <i class="fas fa-plus"></i>
              Add to Cart
            </button>
          </div>

          <div class="item">
            <div
              class="item-img"
              style="background-image: url(gallery/dancake.png)"
            ></div>
            <h3>Dancake</h3>
            <p>$1.99</p>
            <button onclick="addToCart(3, 'Dancake', 1.99)">
              <i class="fas fa-plus"></i>
              Add to Cart
            </button>
          </div>

          <div class="item">
            <div
              class="item-img"
              style="background-image: url(gallery/crispy-sandwitch.png)"
            ></div>
            <h3>Crispy Sandwitch</h3>
            <p>$3.00</p>
            <button onclick="addToCart(4, 'Crispy Sandwitch', 3.00)">
              <i class="fas fa-plus"></i>
              Add to Cart
            </button>
          </div>

          <div class="item">
            <div
              class="item-img"
              style="background-image: url(gallery/thai-soup.png)"
            ></div>
            <h3>Thai Soup</h3>
            <p>$2.79</p>
            <button onclick="addToCart(5, 'Thai Soup', 2.79)">
              <i class="fas fa-plus"></i>
              Add to Cart
            </button>
          </div>

          <div class="item">
            <div
              class="item-img"
              style="background-image: url(gallery/fried-chicken.png)"
            ></div>
            <h3>Fried Chicken</h3>
            <p>$4.00</p>
            <button onclick="addToCart(6, 'Fried Chicken', 159.99)">
              <i class="fas fa-plus"></i>
              Add to Cart
            </button>
          </div>
        </div>


    <!-- Cart Sidebar with Total Section -->
    <div class="cart-sidebar" id="cartSidebar">
      <h3><i class="fas fa-shopping-cart"></i> Your Cart</h3>
      <div class="cart-items" id="cartItems"></div>
      <!-- Total Display Section -->
      <div class="cart-total">
        <hr />
        <div class="total-row">
          <span>Subtotal:</span>
          <span id="subtotal">$0.00</span>
        </div>
        <div class="total-row">
          <span>Tax (10%):</span>
          <span id="tax">$0.00</span>
        </div>
        <div class="total-row grand-total">
          <span>Total:</span>
          <span id="total">$0.00</span>
        </div>
      </div>
      <div class="cart-buttons">
        <div class="button-group">
          <button class="btn btn-close" onclick="toggleCart()">Close</button>
          <button class="btn btn-checkout" onclick="openCheckoutModal()">
            Check Out
          </button>
        </div>
      </div>
    </div>

    <!-- Checkout Modal with User Details -->
    <div class="modal-overlay" id="checkoutModal">
      <div class="modal">
        <h2><i class="fas fa-check-circle"></i> Checkout</h2>
        <form id="checkoutForm">
          <div class="form-group">
            <label for="fullName">Full Name</label>
            <input
              type="text"
              id="fullName"
              name="fullName"
              placeholder="Enter your full name"
              required
            />
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input
              type="text"
              id="address"
              name="address"
              placeholder="Enter your address"
              required
            />
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input
              type="tel"
              id="phone"
              name="phone"
              placeholder="Enter your phone number"
              required
            />
          </div>
          <div class="form-group">
            <label for="paymentMethod">Payment Method</label>
            <select id="paymentMethod" name="paymentMethod" required>
              <option value="cash">Cash on Delivery</option>
              <option value="card">Credit/Debit Card</option>
            </select>
          </div>
          <div class="form-group">
            <p>Total: <strong id="checkoutTotal">$0.00</strong></p>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-checkout">Place Order</button>
            <button
              type="button"
              class="btn btn-close"
              onclick="closeCheckoutModal()"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Order Confirmation Modal -->
    <div class="modal-overlay" id="confirmationModal">
      <div class="modal">
        <h2><i class="fas fa-check-circle"></i> Order Confirmed!</h2>
        <p>Your order has been placed successfully.</p>
        <p>Total: <strong id="confirmedTotal">$0.00</strong></p>
        <button onclick="closeConfirmationModal()">Continue Shopping</button>
      </div>
    </div>

    <script>
      // Enhanced cart functionality with total calculation
      let cart = [];
      let cartOpen = false;

      function addToCart(id, name, price) {
        const existingItem = cart.find((item) => item.id === id);
        if (existingItem) {
          existingItem.quantity++;
        } else {
          cart.push({ id, name, price: parseFloat(price), quantity: 1 });
        }
        updateCartDisplay();
      }

      function updateCartDisplay() {
        const cartItems = document.getElementById("cartItems");
        const cartCount = document.getElementById("cartCount");
        let subtotal = 0;

        cartItems.innerHTML = "";
        cart.forEach((item) => {
          subtotal += item.price * item.quantity;
          const itemElement = document.createElement("div");
          itemElement.className = "cart-item";
          itemElement.innerHTML = `
            <div>
              <h4>${item.name}</h4>
              <p>$${(item.price * item.quantity).toFixed(2)}</p>
            </div>
            <div class="quantity-controls">
              <button class="quantity-btn" onclick="changeQuantity(${
                item.id
              }, -1)">-</button>
              <span>${item.quantity}</span>
              <button class="quantity-btn" onclick="changeQuantity(${
                item.id
              }, 1)">+</button>
              <button class="quantity-btn" onclick="removeItem(${
                item.id
              })">×</button>
            </div>
          `;
          cartItems.appendChild(itemElement);
        });

        // Update totals
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        document.getElementById("subtotal").textContent = `$${subtotal.toFixed(
          2
        )}`;
        document.getElementById("tax").textContent = `$${tax.toFixed(2)}`;
        document.getElementById("total").textContent = `$${total.toFixed(2)}`;
        cartCount.textContent = cart.reduce(
          (sum, item) => sum + item.quantity,
          0
        );
      }

      function changeQuantity(id, delta) {
        const item = cart.find((item) => item.id === id);
        if (item) {
          item.quantity += delta;
          if (item.quantity < 1) {
            removeItem(id);
          }
          updateCartDisplay();
        }
      }

      function removeItem(id) {
        cart = cart.filter((item) => item.id !== id);
        updateCartDisplay();
      }

      function toggleCart() {
        cartOpen = !cartOpen;
        document.getElementById("cartSidebar").classList.toggle("active");
      }

      function openCheckoutModal() {
        const total = document.getElementById("total").textContent;
        document.getElementById("checkoutTotal").textContent = total;
        document.getElementById("checkoutModal").style.display = "flex";
      }

      function closeCheckoutModal() {
        document.getElementById("checkoutModal").style.display = "none";
      }

      function closeConfirmationModal() {
        document.getElementById("confirmationModal").style.display = "none";
        cart = [];
        updateCartDisplay();
      }

      // Handle form submission
      document
        .getElementById("checkoutForm")
        .addEventListener("submit", function (e) {
          e.preventDefault();
          const total = document.getElementById("total").textContent;
          const fullName = document.getElementById("fullName").value;
          const address = document.getElementById("address").value;
          const phone = document.getElementById("phone").value;
          const paymentMethod = document.getElementById("paymentMethod").value;

          // Simulate order processing (you can replace this with an API call)
          console.log("Order Details:", {
            fullName,
            address,
            phone,
            paymentMethod,
            total,
            cart,
          });

          // Show confirmation modal
          document.getElementById("confirmedTotal").textContent = total;
          document.getElementById("checkoutModal").style.display = "none";
          document.getElementById("confirmationModal").style.display = "flex";
        });

      // Function to update user name and email
      window.onload = function () {
        const userEmail = sessionStorage.getItem("userEmail");

        if (userEmail) {
          document.getElementById("userEmail").textContent = userEmail;
        } else {
          window.location.href = "welcome";
        }
      };
    </script>
  </body>
</html>
<?php /**PATH /home/khuliso/baba_tacos/resources/views/items.blade.php ENDPATH**/ ?>