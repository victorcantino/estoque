<?php

use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioEstoquePdo;

require_once __DIR__ . '/../vendor/autoload.php';

$conexao = CriadorDeConexao::criarConexao();
$repo = new RepositorioEstoquePdo($conexao);

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] ===  '/' || $_SERVER['PATH_INFO'] ===  '/lista-estoques') {
    require_once __DIR__ . '/pages/lista-estoque.php';
} elseif ($_SERVER['PATH_INFO'] === '/salva-estoque') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once __DIR__ . '/pages/novo-estoque.php';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/pages/atualiza-estoque.php';
    }
} elseif ($_SERVER['PATH_INFO'] === '/apaga-estoque') {
    require_once __DIR__ . '/pages/apaga-estoque.php';
} elseif ($_SERVER['PATH_INFO'] === '/ativa-estoque') {
    require_once __DIR__ . '/pages/desativa-estoque.php';
} elseif ($_SERVER['PATH_INFO'] === '/ativa-estoque') {
    require_once __DIR__ . '/pages/apaga-estoque.php';
}
