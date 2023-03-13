<?php

namespace Victor\Estoque\Dominio\Entidades;

use Decimal\Decimal;
use Victor\Estoque\Dominio\Entidades\Base;

class Produto extends Base
{
    private int $estoque;
    private Decimal $saldo;

    public function __construct(?int $id, string $nome, string $status, int $estoque, Decimal $saldo)
    {
        parent::__construct($id, $nome, $status);
        $this->estoque = $estoque;
        $this->saldo = $saldo;
    }
    public function getSaldo(): Decimal
    {
        return $this->saldo;
    }

    public function setSaldo(Decimal $saldo): self
    {
        $this->saldo = $saldo->abs();
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
}
