<?php

use Decimal\Decimal;
use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Dominio\Entidades\Movimento;
use Victor\Estoque\Dominio\Entidades\Produto;
use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioEstoquePdo;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioMovimentoPdo;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioProdutoPdo;

require_once './vendor/autoload.php';

$conexao = CriadorDeConexao::criarConexao();

$conexao->exec(file_get_contents('banco-de-dados.sql'));

$repo_esto = new RepositorioEstoquePdo($conexao);

$estoque = new Estoque(null, 'Hack Print 1', Constantes::ATIVADO);
$repo_esto->salva($estoque);

$estoque->setNome('Ecopulse');
$repo_esto->salva($estoque);

$outro = new Estoque(null, 'Hack Print 2', Constantes::DESATIVADO);
$repo_esto->salva($outro);

$estoques = $repo_esto->todos();

$repo_prod = new RepositorioProdutoPdo($conexao);

$produto = new Produto(null, 'Fita Poliéster 20mm', Constantes::ATIVADO, $estoque->getId(), new Decimal(0));
$repo_prod->salva($produto);
$produto->setNome('Fita Branca 20mm');
$repo_prod->salva($produto);

$movimento = new Movimento(null, 'Entrada', '', $produto->getEstoque(), $produto->getId(), new Decimal(1000));
$repo_mov = new RepositorioMovimentoPdo($conexao);
$repo_mov->salva($movimento);
