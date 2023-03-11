<?php

namespace Victor\Estoque\Dominio\Entidades;

use Constantes;
use Decimal\Decimal;

class Produto extends Status
{
    private ?int $id;
    private string $nome;
    private Decimal $saldo;
    private Estoque $estoque;
    private string $status;

    public function __construct(?int $id, string $nome, Decimal $saldo, Estoque $estoque)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->saldo = $saldo;
        $this->estoque = $estoque;
        $this->status = Constantes::ATIVADO;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function atualizaNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function saldo(): Decimal
    {
        return $this->saldo;
    }

    public function atualizaSaldo(Decimal $saldo): self
    {
        $this->saldo = $saldo;
        return $this;
    }

    public function id(): ?int {
        return $this->id;
    }

    public function atualizaId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function estoque(): Estoque {
        return $this->estoque;
    }

    public function status(): string {
        return $this->status;
    }

    public function ativa(): self {
        $this->status = Constantes::ATIVADO;
        return $this;
    }

    public function desativa(): self {
        $this->status = Constantes::DESATIVADO;
        return $this;
    }
}
