<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /site/views/login.php");
    exit;
}

$db = new Database();
$conn = $db->connect();

$id = $_GET['id'];

$sql = "DELETE FROM transactions WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

header("Location: /site/views/dashboard.php");
exit;