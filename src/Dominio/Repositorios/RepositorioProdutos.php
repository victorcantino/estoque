<?php

namespace Victor\Produto\Dominio\Repositorios;

use Decimal\Decimal;
use Victor\Estoque\Dominio\Entidades\Produto;

interface RepositorioProduto
{
    public function salva(Produto $produto): bool;
    public function entrada(Produto $produto, Decimal $quantidade): bool;
    public function saida(Produto $produto, Decimal $quantidade): bool;
    public function balanco(Produto $produto, Decimal $quantidade): bool;
}
