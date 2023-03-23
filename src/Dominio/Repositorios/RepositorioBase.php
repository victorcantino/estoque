<?php

namespace Victor\Estoque\Dominio\Repositorios;

use InvalidArgumentException;
use ReflectionClass;

class RepositorioBase
{
    /**
     * Mapeia o retorno de fetchAll() como um array de Objetos
     */
    protected function mapearLista(array $dados, string $classe): array
    {
        $refClass = new ReflectionClass($classe);
        return array_map(function (array $dadosObjeto) use ($refClass) {
            $args = [];
            foreach ($refClass->getConstructor()->getParameters() as $param) {
                if (array_key_exists($param->getName(), $dadosObjeto)) {
                    $args[] = $dadosObjeto[$param->getName()];
                } elseif ($param->isDefaultValueAvailable()) {
                    $args[] = $param->getDefaultValue();
                } else {
                    throw new InvalidArgumentException("Faltando parâmetro obrigatório: {$param->getName()}");
                }
            }
            return $refClass->newInstanceArgs($args);
        }, $dados);
    }

    /**
     * Mapeia o retorno do fetch() como um objeto.
     */
    protected function mapearObjeto(array $dados, string $classe): ?object
    {
        $lista = $this->mapearLista([$dados], $classe);
        return $lista[0] ?? null;
    }
}
