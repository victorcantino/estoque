<?php

namespace Victor\Estoque\Controle;

use Victor\Estoque\Dominio\Entidades\Base;
use Victor\Estoque\Dominio\Repositorios\RepositorioEstoque;

class ControleEstoque
{
    public function __construct(
        private RepositorioEstoque $repoEstoque
    ) {
    }

    public function todos(): array
    {
        return $this->repoEstoque->todos();
    }

    public function filtra(?string $nome, ?string $status, ?string $ordem): array
    {
        return $this->repoEstoque->filtra($nome, $status, $ordem);
    }

    public function salva(Base $estoque): bool
    {
        return $this->repoEstoque->salva($estoque);
    }

    public function apaga(int $id): bool
    {
        return $this->repoEstoque->apaga($id);
    }

    public function ativa(int $id): bool
    {
        return $this->repoEstoque->ativa($id);
    }

    public function desativa(int $id): bool
    {
        return $this->repoEstoque->desativa($id);
    }
}
