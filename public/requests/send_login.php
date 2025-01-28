<?php
header('Content-Type: application/json');
session_start();

$host = '127.0.0.1';
$dbname = 'babalatte_db';
$username = 'khuliso';
$password = 'password_s';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection error.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $email = trim($input['email']);
    $password = trim($input['password']);

    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Email or password cannot be empty.']);
        exit;
    }

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['user'] = $user['email'];
            echo json_encode(['success' => true, 'message' => 'Login successful!', 'email' => $user['email']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
    }
    exit;
}

$conn->close();
