<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /site/views/login.php");
    exit;
}

require_once "../config/database.php";

$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT * FROM transactions WHERE user_id = :id ORDER BY data DESC");
$stmt->bindParam(":id", $_SESSION['user_id']);
$stmt->execute();

$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

ob_start();
?>

<h2>Olá, <?php echo $_SESSION['nome']; ?> 👋</h2>

<!-- CARDS -->
<div style="display:flex; gap:15px; flex-wrap:wrap;">

    <div style="flex:1; background:#1e1e1e; padding:20px; border-radius:12px;">
        <div>Saldo</div>
        <h3>R$ <?php echo number_format($saldo,2,',','.'); ?></h3>
    </div>

    <div style="flex:1; background:#1e1e1e; padding:20px; border-radius:12px;">
        <div>Entradas</div>
        <h3 style="color:#00ff88;">R$ <?php echo number_format($entradas,2,',','.'); ?></h3>
    </div>

    <div style="flex:1; background:#1e1e1e; padding:20px; border-radius:12px;">
        <div>Saídas</div>
        <h3 style="color:#ff4d4d;">R$ <?php echo number_format($saidas,2,',','.'); ?></h3>
    </div>

</div>

<!-- GRÁFICO -->
<div style="margin-top:30px; background:#1e1e1e; padding:20px; border-radius:12px;">

    <h3>Gráfico Financeiro</h3>

    <canvas id="grafico" height="120"></canvas>

</div>

<!-- CHART.JS (ESSENCIAL) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

<!-- BOTÃO -->
<div style="margin:20px 0;">
    <a href="/site/views/add_transaction.php"
       style="background:#00c3ff; padding:10px 15px; border-radius:10px; color:black; text-decoration:none;">
       + Nova Transação
    </a>
</div>

<!-- TABELA -->
<div style="background:#1e1e1e; padding:15px; border-radius:12px;">

<h3>Transações</h3>

<table style="width:100%; border-collapse:collapse; margin-top:10px; color:white;">

<tr>
    <th align="left">Tipo</th>
    <th align="left">Valor</th>
    <th align="left">Categoria</th>
    <th align="left">Descrição</th>
    <th align="left">Ações</th>
</tr>

<?php foreach ($transactions as $t): ?>
<tr style="border-top:1px solid #333;">

    <td><?php echo $t['tipo']; ?></td>

    <td style="color:<?php echo $t['tipo']=='entrada'?'#00ff88':'#ff4d4d'; ?>">
        R$ <?php echo number_format($t['valor'],2,',','.'); ?>
    </td>

    <td><?php echo $t['categoria']; ?></td>

    <td><?php echo $t['descricao']; ?></td>

    <td>
        <a href="/site/views/edit_transaction.php?id=<?php echo $t['id']; ?>" style="color:#00c3ff;">Editar</a>
        |
        <a href="/site/controllers/deleteTransaction.php?id=<?php echo $t['id']; ?>" style="color:#ff4d4d;">Excluir</a>
    </td>

</tr>
<?php endforeach; ?>

</table>

</div>

<?php
$content = ob_get_clean();
include "layout.php";
?>