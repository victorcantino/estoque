<?php

namespace Victor\Estoque\Dominio\Repositorios;

use Victor\Estoque\Dominio\Entidades\Movimento;

interface RepositorioMovimento
{
    public function salva(Movimento &$movimento): bool;
    public function todos(): array;
}
