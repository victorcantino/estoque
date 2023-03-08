<?php

namespace Victor\Estoque\Dominio\Entidades;

class CorCmyk extends Cor
{
    private string $ciano;
    private string $magenta;
    private string $amarelo;
    private string $preto;

    public function __construct(string $ciano, string $magenta, string $amarelo, string $preto)
    {
        $this->ciano = $ciano;
        $this->magenta = $magenta;
        $this->amarelo = $amarelo;
        $this->preto = $preto;
    }

    public function __toString(): string
    {
        return "{$this->ciano}, {$this->magenta}, {$this->amarelo}, {$this->preto}";
    }
}
