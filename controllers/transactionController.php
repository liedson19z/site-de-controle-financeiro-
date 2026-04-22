<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /site/views/login.php");
    exit;
}

$db = new Database();
$conn = $db->connect();

$user_id = $_SESSION['user_id'];

$tipo = $_POST['tipo'] ?? null;
$valor = $_POST['valor'] ?? null;
$categoria = $_POST['categoria'] ?? null;
$descricao = $_POST['descricao'] ?? null;

$sql = "INSERT INTO transactions 
(user_id, tipo, valor, categoria, descricao, data)
VALUES (:user_id, :tipo, :valor, :categoria, :descricao, NOW())";

$stmt = $conn->prepare($sql);

$stmt->bindParam(":user_id", $user_id);
$stmt->bindParam(":tipo", $tipo);
$stmt->bindParam(":valor", $valor);
$stmt->bindParam(":categoria", $categoria);
$stmt->bindParam(":descricao", $descricao);

$stmt->execute();

header("Location: /site/views/dashboard.php");
exit;