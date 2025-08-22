<?php
/*db.php */
// This page handles the connection to Mysql//?>
<?php
$host = "localhost";
$dbname = "30century-auth";
$user = "root";   // change if not root
$pass = "";       // set your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
