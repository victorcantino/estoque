<?php

use Victor\Estoque\Dominio\Entidades\Cor;
use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioCorPdo;

require_once 'vendor/autoload.php';

$repo = new RepositorioCorPdo(CriadorDeConexao::criarConexao());

$corList = $repo->todasAsCores();
var_dump($corList);
exit;

$cor = new Cor(2, 'branca', null);
if ($repo->remover($cor)) {
    echo 'cor removida';
}
exit;

$cor = new Cor(1, 'branca', null);
if ($repo->salvar($cor)) {
    echo 'cor atualizada';
}
exit;

$corList = $repo->todasAsCmyk();
var_dump($corList);
exit;

$cor = new Cor(null, 'branco', '100,100,100,100');
if ($repo->salvar($cor)) {
    echo 'cor salva';
}
