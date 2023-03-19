<?php

namespace Victor\Estoque\Dominio\Entidades;

use Decimal\Decimal;
use Victor\Estoque\Dominio\Entidades\Base;

class Movimento extends Base
{
    public function __construct(
        private ?int $id,
        private string $nome,
        private string $status,
        private int $estoque,
        private int $produto,
        private Decimal $quantidade
    ) {
        parent::__construct($id, $nome, $status);
    }

    public function getProduto(): int
    {
        return $this->produto;
    }

    public function setProduto(int $produto): self
    {
        $this->produto = $produto;
        return $this;
    }

    public function getEstoque(): int
    {
        return $this->estoque;
    }

    public function setEstoque(int $estoque): self
    {
        $this->estoque = $estoque;
        return $this;
    }

    public function getQuantidade(): Decimal
    {
        return $this->quantidade;
    }

    public function setQuantidade(Decimal $quantidade): self
    {
        $this->quantidade = $quantidade;
        return $this;
    }
}
