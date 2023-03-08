<?php

namespace Victor\Estoque\Dominio\Entidades;

class CorRgb extends Cor
{
    private string $red;
    private string $green;
    private string $blue;

    public function __construct(string $red, string $green, string $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public function __toString()
    {
        return "{$this->red}, {$this->green}, {$this->blue}";
    }
}
