<?php

namespace Victor\Estoque\Dominio\Entidades;

class Cor
{
    private ?int $id;
    private string $nome;
    private ?string $cmyk;

    public function __construct(?int $id, string $nome, ?string $cmyk)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cmyk = $cmyk;
    }
    public function nome(): string
    {
        return $this->nome;
    }
    public function cmyk(): ?string
    {
        return $this->cmyk;
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
