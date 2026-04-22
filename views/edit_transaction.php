<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /site/views/login.php");
    exit;
}

require_once "../config/database.php";

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$database = new Database();
$conn = $database->connect();

$sql = "SELECT * FROM transactions WHERE id = :id AND user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();

$transaction = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Transação</title>

    <style>
        body {
            font-family: Arial;
            background: #121212;
            color: white;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #00c3ff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a {
            color: #00c3ff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2>Editar Transação</h2>

<div class="container">
<form method="POST" action="/site/controllers/updateTransaction.php">

    <input type="hidden" name="id" value="<?php echo $transaction['id']; ?>">

    <select name="tipo">
        <option value="entrada" <?php if($transaction['tipo']=="entrada") echo "selected"; ?>>Entrada</option>
        <option value="saida" <?php if($transaction['tipo']=="saida") echo "selected"; ?>>Saída</option>
    </select>

    <input type="number" step="0.01" name="valor" value="<?php echo $transaction['valor']; ?>">

    <input type="text" name="categoria" value="<?php echo $transaction['categoria']; ?>">

    <input type="text" name="descricao" value="<?php echo $transaction['descricao']; ?>">

    <button type="submit">Atualizar</button>
</form>

<br>
<a href="dashboard.php">⬅ Voltar</a>
</div>

</body>
</html>