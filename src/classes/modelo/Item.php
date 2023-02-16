<?php

namespace hackprint\estoque\classes\modelo;

class Item
{
    public readonly string $descricao;
    public readonly float $quantidade;

    public function __construct(string $descricao, float $quantidade)
    {
        $this->descricao = $descricao;
        $this->quantidade = $quantidade;
    }
}
