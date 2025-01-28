<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$host = "localhost";
$dbname = "baba_latte";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

// Extract data
$userId = $data['userId'];
$fullName = $data['fullName'];
$address = $data['address'];
$phone = $data['phone'];
$totalAmount = $data['totalAmount'];
$paymentMethod = $data['paymentMethod'];
$items = $data['items'];

$orderQuery = $conn->prepare("
    INSERT INTO orders (user_id, full_name, address, phone, total_amount, payment_method)
    VALUES (?, ?, ?, ?, ?, ?)
");
$orderQuery->bind_param("isssds", $userId, $fullName, $address, $phone, $totalAmount, $paymentMethod);

if ($orderQuery->execute()) {
    $orderId = $conn->insert_id;
    $itemQuery = $conn->prepare("
        INSERT INTO order_items (order_id, item_name, item_price, quantity)
        VALUES (?, ?, ?, ?)
    ");

    foreach ($items as $item) {
        $itemQuery->bind_param("isdi", $orderId, $item['name'], $item['price'], $item['quantity']);
        if (!$itemQuery->execute()) {
            echo json_encode(["status" => "error", "message" => "Failed to insert order items"]);
            exit;
        }
    }

    // Send email to the user
    $userEmail = "'orders@babalate.food";
    $subject = "Order Confirmation - Order #$orderId";
    $message = "Dear $fullName,\n\n";
    $message .= "Thank you for your order! Below are the details:\n\n";
    $message .= "Order ID: $orderId\n";
    $message .= "Total Amount: $$totalAmount\n";
    $message .= "Payment Method: $paymentMethod\n\n";
    $message .= "Items Ordered:\n";
    foreach ($items as $item) {
        $message .= "- {$item['name']} (Quantity: {$item['quantity']}, Price: \${$item['price']})\n";
    }
    $message .= "\nWe will process your order shortly.\n\n";
    $message .= "Best regards,\nBabaLatte & Tacos";

    // PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'orders@babalate.food';
        $mail->Password = 'DGFH-GHFH-PPWO-MBNI';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'BabaLatte & Tacos');
        $mail->addAddress($userEmail, $fullName);

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send the email
        $mail->send();

        echo json_encode(["status" => "success", "message" => "Order placed successfully. Confirmation email sent.", "orderId" => $orderId]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Order placed successfully, but email could not be sent. Error: " . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Failed to place order"]);
}

// Close connections
$orderQuery->close();
$itemQuery->close();
$conn->close();
?>
