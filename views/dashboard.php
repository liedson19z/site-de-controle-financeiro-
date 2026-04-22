<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /site/views/login.php");
    exit;
}

require_once "../config/database.php";

$database = new Database();
$conn = $database->connect();

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM transactions WHERE user_id = :user_id ORDER BY data DESC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();

$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// cálculos
$saldo = 0;
$entradas = 0;
$saidas = 0;

foreach ($transactions as $t) {
    if ($t['tipo'] == 'entrada') {
        $saldo += $t['valor'];
        $entradas += $t['valor'];
    } else {
        $saldo -= $t['valor'];
        $saidas += $t['valor'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial;
            background: #121212;
            color: white;
            margin: 0;
            padding: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            padding: 20px;
            border-radius: 10px;
            background: #1e1e1e;
        }

        .entrada { color: #00ff88; }
        .saida { color: #ff4d4d; }

        a {
            color: #00c3ff;
            text-decoration: none;
            margin-right: 10px;
        }

        table {
            width: 100%;
            background: #1e1e1e;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #333;
        }

        td, th {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Olá, <?php echo $_SESSION['nome']; ?> 👋</h2>

<a href="add_transaction.php">➕ Nova Transação</a>
<a href="logout.php">🚪 Sair</a>

<div class="cards">
    <div class="card">
        <h3>Saldo</h3>
        <p>R$ <?php echo number_format($saldo, 2, ',', '.'); ?></p>
    </div>

    <div class="card">
        <h3>Entradas</h3>
        <p class="entrada">R$ <?php echo number_format($entradas, 2, ',', '.'); ?></p>
    </div>

    <div class="card">
        <h3>Saídas</h3>
        <p class="saida">R$ <?php echo number_format($saidas, 2, ',', '.'); ?></p>
    </div>
</div>

<canvas id="grafico" height="100"></canvas>

<script>
const ctx = document.getElementById('grafico');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Entradas', 'Saídas'],
        datasets: [{
            data: [<?php echo $entradas; ?>, <?php echo $saidas; ?>],
            backgroundColor: ['#00ff88', '#ff4d4d']
        }]
    }
});
</script>

<h3>Transações</h3>

<table>
    <tr>
        <th>Tipo</th>
        <th>Valor</th>
        <th>Categoria</th>
        <th>Descrição</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($transactions as $t): ?>
        <tr>
            <td class="<?php echo $t['tipo']; ?>">
                <?php echo $t['tipo']; ?>
            </td>

            <td>R$ <?php echo number_format($t['valor'], 2, ',', '.'); ?></td>

            <td><?php echo $t['categoria']; ?></td>

            <td><?php echo $t['descricao']; ?></td>

            <td><?php echo $t['data']; ?></td>

            <td>
                <a href="/site/views/edit_transaction.php?id=<?php echo $t['id']; ?>">✏️</a>
                <a href="/site/controllers/deleteTransaction.php?id=<?php echo $t['id']; ?>">🗑️</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>