<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST" action="/site/controllers/loginController.php">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="senha" placeholder="Senha" required><br><br>

    <button type="submit">Entrar</button>
</form>

</body>
</html>