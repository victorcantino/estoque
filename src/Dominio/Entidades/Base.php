<?php

namespace Victor\Estoque\Dominio\Entidades;

use Exception;

abstract class Base
{
    public function __construct(
        private ?int $id,
        private string $nome,
        private string $status,
    ) {
    }

    public function __get($propriedade)
    {
        // verifica se o método getPropriedade existe
        $metodo = 'get' . ucfirst($propriedade);
        if (method_exists($this, $metodo)) {
            return $this->$metodo();
        }

        throw new Exception("Propriedade inválida: {$propriedade}");
    }
    public function __set($propriedade, $valor)
    {
        // verifica se o método setPropriedade existe
        $metodo = 'set' . ucfirst($propriedade);
        if (method_exists($this, $metodo)) {
            $this->$metodo($valor);
            return;
        }

        throw new Exception("Propriedade inválida: {$propriedade}");
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }
}
