<?php

namespace Victor\Estoque\Dominio\Entidades;

use Victor\Estoque\Dominio\Entidades\Cor;

class Produto
{
    private string $nome;
    private ?float $largura;
    private ?float  $comprimento;
    private ?float $volume;
    private ?float $peso;
    private ?Cor $cor;

    public function __construct(string $nome, ?float $largura, ?float $comprimento, ?float $volume, ?float $peso, ?Cor $cor)
    {
        $this->nome = $nome;
        $this->largura = $largura;
        $this->comprimento = $comprimento;
        $this->volume = $volume;
        $this->peso = $peso;
        $this->cor = $cor;
    }

    public function recuperaNome()
    {
        return $this->nome;
    }
}
