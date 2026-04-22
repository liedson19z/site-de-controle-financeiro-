<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /site/views/login.php");
    exit;
}

ob_start();
?>

<h2>Nova Transação</h2>

<div style="background:#1e1e1e; padding:20px; border-radius:12px; max-width:400px;">

<form method="POST" action="/site/controllers/transactionController.php">

    <label>Tipo</label><br>
    <select name="tipo" style="width:100%; padding:8px;">
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
    </select>

    <br><br>

    <label>Valor</label><br>
    <input type="number" name="valor" style="width:100%; padding:8px;">

    <br><br>

    <label>Categoria</label><br>
    <input type="text" name="categoria" style="width:100%; padding:8px;">

    <br><br>

    <label>Descrição</label><br>
    <input type="text" name="descricao" style="width:100%; padding:8px;">

    <br><br>

    <button type="submit" style="width:100%; padding:10px; background:#00c3ff; border:none;">
        Salvar
    </button>

</form>

</div>

<?php
$content = ob_get_clean();
include "layout.php";
?>