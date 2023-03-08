<?php

namespace Victor\Estoque\Infraestrutura\Persistencia;

use PDO;

class CriadorDeConexao
{
    public static function criarConexao(): PDO
    {
        $caminhoDoBanco = __DIR__ . '/../../../banco-de-dados.sqlite';
        $conexao = new PDO('sqlite:' . $caminhoDoBanco);
        $conexao->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
        $conexao->setAttribute(attribute: PDO::ATTR_DEFAULT_FETCH_MODE, value: PDO::FETCH_ASSOC);
        return $conexao;
    }
}
