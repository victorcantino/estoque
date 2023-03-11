<?php

namespace Victor\Estoque\Dominio\Entidades;

use Constantes;

abstract class Status
{
    protected $status;

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
