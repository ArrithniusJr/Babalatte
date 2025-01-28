<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order Management</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="css/order_mng.css" type="text/css"/>
  </head>
<body>
  <h1>Order Management</h1>
  <div class="orders-container" id="ordersContainer">
    <!-- Orders -->
  </div>

  <script>
    async function fetchOrders() {
      const response = await fetch("get_orders.php");
      const data = await response.json();
      return data.orders;
    }

    function renderOrders(orders) {
      const ordersContainer = document.getElementById("ordersContainer");
      ordersContainer.innerHTML = "";

      orders.forEach((order) => {
        const orderCard = document.createElement("div");
        orderCard.className = "order-card";

        const itemsList = order.items
          .map(
            (item) =>
              `<li>${item.name} (Quantity: ${item.quantity}, Price: $${item.price})</li>`
          )
          .join("");

        orderCard.innerHTML = `
          <h2>Order #${order.id}</h2>
          <p><strong>Customer:</strong> ${order.full_name}</p>
          <p><strong>Address:</strong> ${order.address}</p>
          <p><strong>Phone:</strong> ${order.phone}</p>
          <p><strong>Total Amount:</strong> $${order.total_amount}</p>
          <p><strong>Payment Method:</strong> ${order.payment_method}</p>
          <div class="status ${order.status}">${order.status}</div>
          <div class="items-list">
            <ul>${itemsList}</ul>
          </div>
          <div class="actions">
            <button class="complete" onclick="updateOrderStatus(${order.id}, 'completed')">Mark as Completed</button>
            <button class="cancel" onclick="updateOrderStatus(${order.id}, 'cancelled')">Cancel Order</button>
          </div>
        `;

        ordersContainer.appendChild(orderCard);
      });
    }

    async function updateOrderStatus(orderId, status) {
      const response = await fetch("update_order_status.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ orderId, status }),
      });
      const data = await response.json();

      if (data.status === "success") {
        alert("Order status updated successfully!");
        loadOrders();
      } else {
        alert("Failed to update order status.");
      }
    }

    async function loadOrders() {
      const orders = await fetchOrders();
      renderOrders(orders);
    }

    loadOrders();
  </script>
</body>
</html>
