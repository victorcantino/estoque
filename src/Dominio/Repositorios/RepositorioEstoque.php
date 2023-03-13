<?php

namespace Victor\Estoque\Dominio\Repositorios;

use Victor\Estoque\Dominio\Entidades\Estoque;

interface RepositorioEstoque
{
    public function salva(Estoque &$estoque): bool;
    public function todos(): array;
}
