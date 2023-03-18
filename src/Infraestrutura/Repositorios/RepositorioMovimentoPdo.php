<?php

namespace Victor\Estoque\Infraestrutura\Repositorios;

use PDO;
use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Movimento;
use Victor\Estoque\Dominio\Repositorios\RepositorioMovimento;

class RepositorioMovimentoPdo implements RepositorioMovimento
{
    public function __construct(
        private PDO &$conexao
    ) {
    }

    public function todos(): array
    {
        $sql = 'SELECT id, nome, status, id_estoque, id_produto, quantidade FROM movimentos;';
        return $this->hidratar($this->conexao->query($sql)->fetchAll());
    }

    private function hidratar(array $movimentos): ?array
    {
        return array_map(function (array $dados) {
            return new Movimento(...$dados);
        }, $movimentos);
    }

    public function salva(Movimento &$movimento): bool
    {
        if ($movimento->getId() === null) {
            return $this->novo($movimento);
        }
        return $this->atualiza($movimento);
    }

    private function novo(Movimento &$movimento): bool
    {
        $sql = <<<INSERIR
        INSERT INTO movimentos (id_estoque, id_produto, nome, status, quantidade, criadoEm) 
        VALUES (:id_estoque, :id_produto, :nome, :status, :quantidade, :criadoEm);
        INSERIR;
        $inserir = $this->conexao->prepare($sql);
        $inserir->bindValue(':id_estoque', $movimento->getEstoque(), PDO::PARAM_INT);
        $inserir->bindValue(':id_produto', $movimento->getProduto(), PDO::PARAM_INT);
        $inserir->bindValue(':nome', $movimento->getNome());
        $inserir->bindValue(':status', $movimento->getStatus());
        $inserir->bindValue(':quantidade', $movimento->getQuantidade());
        $inserir->bindValue(':criadoEm', Constantes::agora());
        $sucesso = $inserir->execute();
        if ($sucesso) {
            $movimento->setId($this->conexao->lastInsertId());
        }
        return $sucesso;
    }

    private function atualiza(Movimento $movimento): bool
    {
        $sql = <<<ATUALIZAR
        UPDATE movimentos SET 
            id_estoque = :id_estoque, 
            id_produto = :id_produto, 
            nome = :nome, 
            status = :status, 
            quantidade = :quantidade, 
            atualizadoEm = :atualizadoEm 
        WHERE id = :id;
        ATUALIZAR;
        $atualizar = $this->conexao->prepare($sql);
        $atualizar->bindValue(':id', $movimento->getId(), PDO::PARAM_INT);
        $atualizar->bindValue(':id_estoque', $movimento->getEstoque(), PDO::PARAM_INT);
        $atualizar->bindValue(':id_produto', $movimento->getProduto(), PDO::PARAM_INT);
        $atualizar->bindValue(':nome', $movimento->getNome());
        $atualizar->bindValue(':status', $movimento->getStatus());
        $atualizar->bindValue(':quantidade', $movimento->getQuantidade());
        $atualizar->bindValue(':atualizadoEm', Constantes::agora());
        return $atualizar->execute();
    }
}
