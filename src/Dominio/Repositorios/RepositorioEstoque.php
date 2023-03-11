<?php

namespace Victor\Produto\Dominio\Repositorios;

use Victor\Estoque\Dominio\Entidades\Estoque;

interface RepositorioEstoque
{
    public function salva(Estoque $estoque): bool;
}
