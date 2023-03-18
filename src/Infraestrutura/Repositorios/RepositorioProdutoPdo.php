<?php

namespace Victor\Estoque\Infraestrutura\Repositorios;

use PDO;
use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Produto;
use Victor\Estoque\Dominio\Repositorios\RepositorioProduto;

class RepositorioProdutoPdo implements RepositorioProduto
{
    public function __construct(
        private PDO &$conexao
    ) {
    }

    public function todos(): array
    {
        $sql = 'SELECT id, nome, status, id_estoque, saldo FROM produtos;';
        return $this->mapear($this->conexao->query($sql)->fetchAll());
    }

    private function mapear(array $produtos): array
    {
        return array_map(function (array $dados) {
            return new Produto(...$dados);
        }, $produtos);
    }

    public function salva(Produto &$produto): bool
    {
        if ($produto->getId() === null) {
            return $this->novo($produto);
        }
        return $this->atualiza($produto);
    }

    private function novo(Produto &$produto)
    {
        $sql = <<<INSERIR
        INSERT INTO produtos (id_estoque, nome, saldo, status, criadoEm) 
        VALUES (:id_estoque, :nome, :saldo, :status, :criadoEm);
        INSERIR;
        $inserir = $this->conexao->prepare($sql);
        $inserir->bindValue(':id_estoque', $produto->getEstoque(), PDO::PARAM_INT);
        $inserir->bindValue(':nome', $produto->getNome());
        $inserir->bindValue(':saldo', $produto->getSaldo());
        $inserir->bindValue(':status', $produto->getStatus());
        $inserir->bindValue(':criadoEm', Constantes::agora());
        $sucesso = $inserir->execute();
        if ($sucesso) {
            $produto->setId($this->conexao->lastInsertId());
        }
        return $sucesso;
    }

    private function atualiza(Produto $produto): bool
    {
        $sql = <<<ATUALIZA
        UPDATE produtos SET 
            nome = :nome,
            saldo = :saldo, 
            status = :status, 
            atualizadoEm = :atualizadoEm 
        WHERE id = :id;
        ATUALIZA;

        $update = $this->conexao->prepare($sql);
        $update->bindValue(':id', $produto->getId(), PDO::PARAM_INT);
        $update->bindValue(':nome', $produto->getNome());
        $update->bindValue(':saldo', $produto->getSaldo());
        $update->bindValue(':status', $produto->getStatus());
        $update->bindValue(':atualizadoEm', Constantes::agora());
        return $update->execute();
    }
}
