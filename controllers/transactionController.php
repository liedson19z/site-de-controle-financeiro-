<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $data = date("Y-m-d");

    $database = new Database();
    $conn = $database->connect();

    $sql = "INSERT INTO transactions 
            (user_id, tipo, valor, categoria, descricao, data)
            VALUES (:user_id, :tipo, :valor, :categoria, :descricao, :data)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":tipo", $tipo);
    $stmt->bindParam(":valor", $valor);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":data", $data);

    if ($stmt->execute()) {
        header("Location: /site/views/dashboard.php");
        exit;
    } else {
        echo "Erro ao salvar";
    }
}