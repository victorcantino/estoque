<?php

namespace Victor\Estoque\Dominio\Entidades;

use Decimal\Decimal;

class Movimento extends Base
{
    private int $produto;
    private int $estoque;
    private Decimal $quantidade;

    public function __construct(?int $id, string $nome, string $status, int $produto, int $estoque, Decimal $quantidade)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->status = $status;
        $this->produto = $produto;
        $this->estoque = $estoque;
        $this->quantidade = $quantidade;
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
