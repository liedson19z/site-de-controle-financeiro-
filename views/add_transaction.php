<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /site/views/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nova Transação</title>

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

<h2>Nova Transação</h2>

<div class="container">
<form method="POST" action="/site/controllers/transactionController.php">
    
    <select name="tipo" required>
        <option value="">Tipo</option>
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
    </select>

    <input type="number" step="0.01" name="valor" placeholder="Valor" required>

    <input type="text" name="categoria" placeholder="Categoria">

    <input type="text" name="descricao" placeholder="Descrição">

    <button type="submit">Salvar</button>
</form>

<br>
<a href="dashboard.php">⬅ Voltar</a>
</div>

</body>
</html>