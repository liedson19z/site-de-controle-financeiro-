<?php if (!isset($content)) $content = ""; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Finance App</title>
</head>

<body style="margin:0; font-family:Arial; background:#0b0b0b; color:white;">

<!-- NAVBAR SUPERIOR -->
<div style="
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 20px;
    background:#151515;
    border-bottom:1px solid #222;
">

    <!-- ESQUERDA -->
    <div style="display:flex; gap:10px;">

        <a href="/site/views/dashboard.php"
           style="padding:8px 12px; background:#1e1e1e; color:white; text-decoration:none; border-radius:8px;">
           📊 Dashboard
        </a>

        <a href="/site/views/add_transaction.php"
           style="padding:8px 12px; background:#1e1e1e; color:white; text-decoration:none; border-radius:8px;">
           ➕ Nova Transação
        </a>

    </div>

    <!-- DIREITA -->
    <div>

        <a href="/site/controllers/logout.php"
           style="padding:8px 12px; background:#ff4d4d; color:white; text-decoration:none; border-radius:8px;">
           🚪 Sair
        </a>

    </div>

</div>

<!-- CONTEÚDO -->
<div style="padding:20px;">
    <?php echo $content; ?>
</div>

</body>
</html>