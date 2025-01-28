<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$host = '127.0.0.1';
$dbname = 'babalatte_db';
$username = 'khuliso';
$password = 'password_s';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$orderId = $data['orderId'];
$status = $data['status'];

$updateQuery = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
$updateQuery->bind_param("si", $status, $orderId);

if ($updateQuery->execute()) {
    echo json_encode(["status" => "success", "message" => "Order status updated successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to update order status"]);
}

$updateQuery->close();
$conn->close();
?>
