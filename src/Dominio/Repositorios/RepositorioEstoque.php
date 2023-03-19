<?php

namespace Victor\Estoque\Dominio\Repositorios;

use Victor\Estoque\Dominio\Entidades\Estoque;

interface RepositorioEstoque
{
    public function salva(Estoque &$estoque): bool;
    public function todos(): array;
    public function recupera(int $id): ?Estoque;
    public function apaga(int $id): bool;
    public function filtra(?string $nome, ?string $status): ?array;
}
