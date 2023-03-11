<?php

namespace Victor\Estoque\Dominio\Entidades;

use Constantes;

class Estoque extends Status
{
    private ?int $id;
    private string $nome;
    private string $status;

    public function __construct(?int $id, string $nome, string $status)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->status = $status;
    }

    public function atualizaNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function atualizaId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function ativa(): self
    {
        $this->status = Constantes::ATIVADO;
        return $this;
    }

    public function desativa(): self
    {
        $this->status = Constantes::DESATIVADO;
        return $this;
    }
}
