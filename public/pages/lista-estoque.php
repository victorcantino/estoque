<?php

use Victor\Estoque\Dominio\Constantes;

$filtraNome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$filtraStatus = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ordem = filter_input(INPUT_GET, 'ordem', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$listaEstoque = empty($_GET) ? $repo->todos() : $repo->filtra($filtraNome, $filtraStatus, $ordem);
$sucesso = filter_input(INPUT_GET, 'sucesso', FILTER_VALIDATE_BOOL);
require_once 'inicio-html.php';
?>
    <section class="w3-container">
        <a href="/salva-estoque" class="w3-button">Novo Estoque</a>
        <fieldset>
            <legend>Filtros</legend>
            <a href="/">Todos</a>
            <a href="/?status=<?= Constantes::ATIVADO?>"><?= Constantes::ATIVADO?></a>
            <a href="/?status=<?= Constantes::DESATIVADO?>"><?= Constantes::DESATIVADO?></a>
            <a href="/?ordem=nome">Por nome</a>
            <a href="/?ordem=status">Por status</a>
        </fieldset>
        <ul class="w3-ul">
            <?php foreach ($listaEstoque as $estoque) : ?>
                <li><?= $estoque->getId() . ' - ' . $estoque->getNome() . ' - ' . $estoque->getStatus(); ?>
                <a href="/apaga-estoque?id=<?= $estoque->getId(); ?>">Apagar</a>
                <a href="/salva-estoque?id=<?= $estoque->getId(); ?>">Alterar</a></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php require_once 'fim-html.php';?>