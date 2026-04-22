<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?? "Login"; ?></title>

    <style>
        body {
            font-family: Arial;
            background: #121212;
            margin: 0;
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .auth-box {
            width: 100%;
            max-width: 400px;
            background: #1e1e1e;
            padding: 30px;
            border-radius: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background: #2a2a2a;
            border: none;
            border-radius: 5px;
            color: white;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #00c3ff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #00c3ff;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="auth-box">
    <?php echo $content; ?>
</div>

</body>
</html>