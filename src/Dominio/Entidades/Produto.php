<?php

namespace Victor\Estoque\Dominio\Entidades;

use Decimal\Decimal;
use Victor\Estoque\Dominio\Entidades\Base;

class Produto extends Base
{
    public function __construct(
        private ?int $id,
        private string $nome,
        private string $status,
        private int $estoque,
        private Decimal $saldo
    ) {
        parent::__construct($id, $nome, $status);
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
