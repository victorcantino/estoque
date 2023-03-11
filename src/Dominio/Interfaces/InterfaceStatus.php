<?php

namespace Victor\Produto\Dominio\Repositorios;

use Victor\Estoque\Dominio\Entidades\Status;

interface InterfaceStatus
{
    public function ativa(Status $objeto): bool;
    public function desativa(Status $objeto): bool;
}
