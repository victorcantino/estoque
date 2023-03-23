<?php

use Victor\Estoque\Dominio\Constantes;

require_once 'inicio-html.php';
?>
    <form class="w3-container" action="salva-estoque.php" method="post">
        <input type="hidden" name="id">
        <label for="nome">Nome</label>
        <input class="w3-input" type="text" name="nome" id="nome" placeholder="Exemplo: Serigrafia, Sublimação">
        <label for="status">Status</label>
        <input value="<?= Constantes::ATIVADO ?>" class="w3-input" type="text" name="status" id="status" placeholder="Exemplo: ATIVADO, DESATIVADO">
        <input class="w3-button" type="submit" value="Salvar">
        <a class="w3-button" href="../index.php">Cancelar</a>
    </form>
<?php require_once 'fim-html.php';?>