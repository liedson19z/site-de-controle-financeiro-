<?php
session_start();
require_once "../config/database.php";

$db = new Database();
$conn = $db->connect();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['senha'])) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nome'] = $user['nome'];

    header("Location: /site/views/dashboard.php");
    exit;
}

header("Location: /site/views/login.php");
exit;