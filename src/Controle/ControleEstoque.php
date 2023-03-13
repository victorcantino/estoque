<?php

namespace Victor\Estoque\Controle;

use PDO;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Dominio\Repositorios\RepositorioEstoque;

class ControleEstoque
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function salva(Estoque $estoque)
    {
        $repo = new RepositorioEstoque($this->conexao);
        $repo->salva($estoque);
    }
}
