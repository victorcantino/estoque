<?php

namespace Victor\Estoque\Infraestrutura\Persistencia;

use PDO;

class CriadorDeConexao
{
    public static function criarConexao(): PDO
    {
        $caminhoDoBanco = __DIR__ . '/../../../banco-de-dados.sqlite';
        return new PDO('sqlite:' . $caminhoDoBanco);
    }
}
