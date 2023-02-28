<?php

namespace Victor\Estoque\Dominio\Entidades;

use Victor\Estoque\Dominio\Entidades\Produto;

class Item
{
    private Produto $produto;
    private float $quantidade;

    public function __construct(Produto $produto, float $quantidade)
    {
        $this->produto = $produto;
        $this->quantidade = $quantidade;
    }

    public function recuperaNome()
    {
        return $this->produto->recuperaNome();
    }

    public function recuperaQuantidade()
    {
        return $this->quantidade;
    }
}
