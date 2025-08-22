<?php
/*login_process.php */
//This page handles the AJAX login //?>
<?php
require "db.php";
session_start();

header("Content-Type: application/json");

$login = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';

if (!$login || !$password) {
    echo json_encode(["success" => false, "message" => "Both fields required."]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
$stmt->execute([$login, $login]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user['username'];
    echo json_encode(["success" => true, "message" => "Login successful!"]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid credentials."]);
}
