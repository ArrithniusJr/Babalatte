<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$host = '127.0.0.1';
$dbname = 'babalatte_db';
$username = 'khuliso';
$password = 'password_s';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ordersQuery = "
    SELECT o.id, o.user_id, o.full_name, o.address, o.phone, o.total_amount, o.payment_method, o.status, o.created_at,
           oi.item_name, oi.item_price, oi.quantity
    FROM orders o
    LEFT JOIN order_items oi ON o.id = oi.order_id
    ORDER BY o.created_at DESC
";
$result = $conn->query($ordersQuery);

if ($result->num_rows > 0) {
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orderId = $row['id'];

        if (!isset($orders[$orderId])) {
            $orders[$orderId] = [
                "id" => $row['id'],
                "user_id" => $row['user_id'],
                "full_name" => $row['full_name'],
                "address" => $row['address'],
                "phone" => $row['phone'],
                "total_amount" => $row['total_amount'],
                "payment_method" => $row['payment_method'],
                "status" => $row['status'],
                "created_at" => $row['created_at'],
                "items" => []
            ];
        }

        if ($row['item_name']) {
            $orders[$orderId]['items'][] = [
                "name" => $row['item_name'],
                "price" => $row['item_price'],
                "quantity" => $row['quantity']
            ];
        }
    }

    $orders = array_values($orders);

    echo json_encode(["status" => "success", "orders" => $orders]);
} else {
    echo json_encode(["status" => "success", "orders" => []]);
}

$conn->close();
?>
