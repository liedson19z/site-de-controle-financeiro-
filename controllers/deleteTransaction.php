<?php
session_start();

require_once "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /site/views/login.php");
    exit;
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $database = new Database();
    $conn = $database->connect();

    $sql = "DELETE FROM transactions WHERE id = :id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":user_id", $user_id);

    if ($stmt->execute()) {
        header("Location: /site/views/dashboard.php");
        exit;
    } else {
        echo "Erro ao excluir";
    }
}