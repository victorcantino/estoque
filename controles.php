<?php

use Victor\Estoque\Controle\ControleEstoque;
use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioEstoquePdo;

require_once './vendor/autoload.php';

$conexao = CriadorDeConexao::criarConexao();
$conexao->exec(file_get_contents('banco-de-dados.sql'));
$repoEstoque = new RepositorioEstoquePdo($conexao);
$controle = new ControleEstoque($repoEstoque);
$estoque1 = new Estoque(null, 'Estoque 01', Constantes::ATIVADO);
$controle->salva($estoque1);
$controle->desativa($estoque1->getId());
var_dump($estoque1, $controle->filtra(null, 'DESATIVADO', null));
