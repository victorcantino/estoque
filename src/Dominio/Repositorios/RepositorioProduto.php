<?php

namespace Victor\Estoque\Dominio\Repositorios;

use Victor\Estoque\Dominio\Entidades\Produto;

interface RepositorioProduto
{
    public function salva(Produto &$produto): bool;
    public function todos(): array;
}
