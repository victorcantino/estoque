<?php

namespace Victor\Estoque\Dominio\Entidades;

class Cor
{
    private ?int $id;
    private string $nome;

    public function __construct(?int $id, string $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }
    public function nome(): string
    {
        return $this->nome;
    }
    public function id(): ?int
    {
        return $this->id;
    }
    public function defineId(int $id): void
    {
        $this->id = $id;
    }
}
