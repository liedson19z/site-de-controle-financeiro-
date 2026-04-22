<?php
session_start();

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];

    $database = new Database();
    $conn = $database->connect();

    $sql = "UPDATE transactions 
            SET tipo = :tipo, valor = :valor, categoria = :categoria, descricao = :descricao
            WHERE id = :id AND user_id = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":tipo", $tipo);
    $stmt->bindParam(":valor", $valor);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":user_id", $user_id);

    if ($stmt->execute()) {
        header("Location: /site/views/dashboard.php");
        exit;
    } else {
        echo "Erro ao atualizar";
    }
}