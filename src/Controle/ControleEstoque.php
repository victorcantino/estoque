<?php

namespace Victor\Estoque\Controle;

use PDO;
use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Base;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioEstoquePdo;

class ControleEstoque
{
    private RepositorioEstoquePdo $repoEstoque;

    public function __construct(PDO &$conexao)
    {
        $this->repoEstoque = new RepositorioEstoquePdo($conexao);
    }

    public function salva(Base $estoque): bool
    {
        return $this->repoEstoque->salva($estoque);
    }

    public function desativa(Base $estoque): bool
    {
        $estoque->setStatus(Constantes::DESATIVADO);
        return $this->repoEstoque->salva($estoque);
    }

    public function ativa(Base $estoque): bool
    {
        $estoque->setStatus(Constantes::ATIVADO);
        return $this->repoEstoque->salva($estoque);
    }

    public function todos(): array
    {
        return $this->repoEstoque->todos();
    }

    public function filtrar(Estoque $estoque): array
    {
        return $this->repoEstoque->filtrar($estoque);
    }
}
