<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $database = new Database();
    $conn = $database->connect();

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];

        header("Location: /site/views/dashboard.php");
        exit;

    } else {
        echo "Email ou senha incorretos!";
    }
}