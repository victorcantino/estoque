<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
$estoque = $id !== null ? $repo->recupera($id) : null;
require_once 'inicio-html.php';
?>
    <form class="w3-container" action="/pages/salva-estoque.php" method="post">
        <input value="<?= $estoque !== null ? $estoque->id : '';?>" type="hidden" name="id">
        <label for="nome">Nome</label>
        <input value="<?= $estoque !== null ? $estoque->nome : ''; ?>" class="w3-input" type="text" name="nome" id="nome" placeholder="Exemplo: Serigrafia, Sublimação">
        <label for="status">Status</label>
        <input value="<?= $estoque !== null ? $estoque->status : ''; ?>" class="w3-input" type="text" name="status" id="status" placeholder="Exemplo: ATIVADO, DESATIVADO">
        <input class="w3-button" type="submit" value="Salvar">
        <a class="w3-button" href="../index.php">Cancelar</a>
    </form>
<?php require_once 'fim-html.php';?>