<?php

namespace Victor\Estoque\Dominio\Repositorios;

use Victor\Estoque\Dominio\Entidades\Cor;

interface RepositorioCor
{
    public function todasAsCores(): array;
    public function todasAsCmyk(): array;
    public function salvar(Cor &$cor): bool;
    public function remover(Cor $cor): bool;
}
