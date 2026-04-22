<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: linear-gradient(135deg, #0f0f0f, #1a1a1a);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 320px;
            background: #1e1e1e;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
            text-align: center;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: none;
            border-radius: 10px;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 10px;
            background: #00c3ff;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #00a3d1;
        }

        .footer {
            margin-top: 10px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>

<body>

<div class="card">

    <h2>Bem-vindo</h2>

    <form method="POST" action="/site/controllers/loginController.php">

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Senha" required>

        <button type="submit">Entrar</button>

    </form>

    <div class="footer">
        Sistema Financeiro
    </div>

</div>

</body>
</html>