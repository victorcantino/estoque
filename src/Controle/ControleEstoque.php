<?php

namespace Victor\Estoque\Controle;

use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Base;
use Victor\Estoque\Dominio\Repositorios\RepositorioEstoque;

class ControleEstoque
{
    private RepositorioEstoque $repoEstoque;

    public function __construct(RepositorioEstoque $repoEstoque)
    {
        $this->repoEstoque = $repoEstoque;
    }

    public function salva(Base $estoque): bool
    {
        return $this->repoEstoque->salva($estoque);
    }

    public function apaga($int $id): bool
    {
        return $this->repoEstoque->re($estoque);
    }

    public function todos(): array
    {
        return $this->repoEstoque->todos();
    }
}
