<?php

require_once __DIR__ . '../../../vendor/autoload.php';

use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Dominio\Regex;
use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioEstoquePdo;

$conexao = CriadorDeConexao::criarConexao();
$repo = new RepositorioEstoquePdo($conexao);

/**
 * $id = null, cria num novo estoque
 * $id > 0, atualiza informações do estoque
 */
$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT,
    array(
        'options' => array(
            'min_range' => 1,
            'max_range' => null,
            'default' => FILTER_NULL_ON_FAILURE
        )
    )
);
$nome_limpo = filter_input(
    INPUT_POST,
    'nome',
    FILTER_SANITIZE_FULL_SPECIAL_CHARS
);
$nome_valido = filter_var(
    $nome_limpo,
    FILTER_VALIDATE_REGEXP,
    ['options' => ['regexp' => Regex::INICIA_COM_TRES_LETRAS]]
);
$status_limpo = filter_input(
    INPUT_POST,
    'status',
    FILTER_SANITIZE_FULL_SPECIAL_CHARS
);
$status_valido = filter_var(
    $status_limpo,
    FILTER_VALIDATE_REGEXP,
    ['options' => ['regexp' => Regex::INICIA_COM_TRES_LETRAS]]
);
$sucesso = $nome_valido && $status_valido ?
    $repo->salva(new Estoque($id, $nome, $status)) :
    false;
header("Location: /index.php?sucesso=" . urlencode($sucesso ? "true" : "false"));
