<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "CHEGUEI AQUI<br>";

    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = password_hash($_POST['senha'] ?? '', PASSWORD_DEFAULT);

    $database = new Database();
    $conn = $database->connect();

    if (!$conn) {
        die("Erro na conexão com o banco");
    }

    try {

        $sql = "INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao executar cadastro";
        }

    } catch (PDOException $e) {

        echo "ERRO CAPTURADO:<br>";

        if ($e->getCode() == 23000) {
            echo "Esse email já está cadastrado!";
        } else {
            echo $e->getMessage();
        }
    }
}