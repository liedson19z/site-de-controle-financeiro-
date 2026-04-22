<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/database.php";

$database = new Database();
$conn = $database->connect();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: dashboard.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM transactions WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();

$t = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$t) {
    header("Location: dashboard.php");
    exit;
}

$title = "Editar Transação";

ob_start();
?>

<div class="form-container">

    <h2 class="form-title">✏️ Editar Transação</h2>

    <a href="/site/views/dashboard.php" style="
        display:inline-block;
        margin-bottom:15px;
        color:#00c3ff;
        text-decoration:none;
    ">
        ← Voltar para o Dashboard
    </a>

    <form method="POST" action="/site/controllers/updateTransaction.php">

        <input type="hidden" name="id" value="<?php echo $t['id']; ?>">

        <label>Tipo</label>
        <select name="tipo" required>
            <option value="entrada" <?php if ($t['tipo'] == 'entrada') echo 'selected'; ?>>
                Entrada
            </option>

            <option value="saida" <?php if ($t['tipo'] == 'saida') echo 'selected'; ?>>
                Saída
            </option>
        </select>

        <label>Valor</label>
        <input type="number" name="valor" step="0.01" value="<?php echo $t['valor']; ?>" required>

        <label>Categoria</label>
        <input type="text" name="categoria" value="<?php echo $t['categoria']; ?>" required>

        <label>Descrição</label>
        <input type="text" name="descricao" value="<?php echo $t['descricao']; ?>">

        <button type="submit">Atualizar</button>

    </form>

</div>

<?php
$content = ob_get_clean();
include "layout.php";
?>