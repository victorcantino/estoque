<?php

use Victor\Estoque\Controle\ControleEstoque;
use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;

require_once './vendor/autoload.php';

$conexao = CriadorDeConexao::criarConexao();

$conexao->exec(file_get_contents('banco-de-dados.sql'));

$controle = new ControleEstoque($conexao);
$estoque1 = new Estoque(null, 'Estoque 01', Constantes::ATIVADO);
$controle->salva($estoque1);
$controle->desativa($estoque1);


var_dump($controle->filtrar($estoque1));
