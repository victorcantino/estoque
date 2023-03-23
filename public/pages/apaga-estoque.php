<?php

require_once __DIR__ . '../../../vendor/autoload.php';

use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioEstoquePdo;

$conexao = CriadorDeConexao::criarConexao();
$repo = new RepositorioEstoquePdo($conexao);
$id = isset($_GET['id']) ? filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) : null;
$sucesso = $id > 0 ? $repo->apaga($id) : false;
header("Location: /index.php?sucesso=" . urlencode($sucesso ? "true" : "false"));
