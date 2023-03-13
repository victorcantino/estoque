<?php

namespace Victor\Estoque\Dominio\Entidades;

use DateTimeImmutable;

abstract class Base
{
    protected ?int $id;
    protected string $nome;
    protected string $status;

    public function __construct(?int $id, string $nome, string $status)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->status = $status;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }
}
