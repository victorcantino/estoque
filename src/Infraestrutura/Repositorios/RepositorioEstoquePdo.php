<?php

namespace Victor\Estoque\Infraestrutura\Repositorios;

use PDO;
use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Dominio\Repositorios\RepositorioEstoque;

class RepositorioEstoquePdo implements RepositorioEstoque
{
    public function __construct(
        private PDO &$conexao
    ) {
    }

    public function todos(): array
    {
        $sql = 'SELECT id, nome, status FROM estoques;';
        return $this->mapear($this->conexao->query($sql)->fetchAll());
    }

    public function filtrar(Estoque $estoque): array
    {
        $sql = 'SELECT id, nome, status FROM estoques WHERE nome = :nome;';
        $filtrar = $this->conexao->query($sql);
        $filtrar->bindValue(':nome', $estoque->getNome());
        return $this->mapear($filtrar->fetchAll());
    }

    private function mapear(array $estoques): ?array
    {
        return array_map(function (array $dados) {
            return new Estoque(...$dados);
        }, $estoques);
    }

    public function salva(Estoque &$estoque): bool
    {
        if ($estoque->getId() === null) {
            return $this->novo($estoque);
        }
        return $this->atualiza($estoque);
    }

    private function novo(Estoque &$estoque): bool
    {
        $sql = 'INSERT INTO estoques (nome, status, criadoEm) VALUES (:nome, :status, :criadoEm);';
        $inserir = $this->conexao->prepare($sql);
        $inserir->bindValue(':nome', $estoque->getNome());
        $inserir->bindValue(':status', $estoque->getStatus());
        $inserir->bindValue(':criadoEm', Constantes::agora());
        $sucesso = $inserir->execute();
        if ($sucesso) {
            $estoque->setId($this->conexao->lastInsertId());
        }
        return $sucesso;
    }

    private function atualiza(Estoque $estoque): bool
    {
        $sql = <<<ATUALIZA
        UPDATE estoques SET 
            nome = :nome, 
            status = :status, 
            atualizadoEm = :atualizadoEm 
        WHERE id = :id;
        ATUALIZA;
        $atualizar = $this->conexao->prepare($sql);
        $atualizar->bindValue(':id', $estoque->getId(), PDO::PARAM_INT);
        $atualizar->bindValue(':nome', $estoque->getNome());
        $atualizar->bindValue(':status', $estoque->getStatus());
        $atualizar->bindValue(':atualizadoEm', Constantes::agora());
        return $atualizar->execute();
    }
}
