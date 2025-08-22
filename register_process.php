/<?php
/*register_process.php   */
//This handles the AJAX registration //?>
<?php
require "db.php";

header("Content-Type: application/json");

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if (!$username || !$email || !$password || !$confirm) {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit;
}

if ($password !== $confirm) {
    echo json_encode(["success" => false, "message" => "Passwords do not match."]);
    exit;
}

// Check if email or username exists
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
$stmt->execute([$email, $username]);
if ($stmt->rowCount() > 0) {
    echo json_encode(["success" => false, "message" => "Email or username already exists."]);
    exit;
}

// Hash and insert
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hash]);

echo json_encode(["success" => true, "message" => "Registration successful! You can login now."]);
