<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
</head>
<body>

<h2>Cadastro</h2>

<form method="POST" action="/site/controllers/registerController.php">
    <input type="text" name="nome" placeholder="Nome" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="senha" placeholder="Senha" required><br><br>

    <button type="submit">Cadastrar</button>
</form>

</body>
</html>