<?php

namespace Victor\Estoque\Infraestrutura\Repositorios;

use Constantes;
use PDO;
use Decimal\Decimal;
use RuntimeException;
use Victor\Estoque\Dominio\Entidades\Produto;
use Victor\Produto\Dominio\Repositorios\RepositorioProduto;

class RepositorioEstoquePdo implements RepositorioProduto
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function produtos(): array
    {
        return $this->conexao->query('SELECT * FROM produtos;')->fetchAll();
    }

    public function salva(Produto $produto): bool
    {
        if ($produto->id() === null) {
            return $this->novo($produto);
        }
        return $this->atualizaNome($produto);
    }

    private function novo(Produto $produto)
    {
        $update = $this->conexao->prepare('INSERT INTO produtos (nome, id_estoque, saldo) VALUES (:nome, :id_estoque, :saldo);');
        $update->bindValue(':id', $produto->id(), PDO::PARAM_INT);
        $update->bindValue(':id_estoque', $produto->estoque()->id(), PDO::PARAM_INT);
        $update->bindValue(':nome', $produto->nome(), PDO::PARAM_STR);
        $update->bindValue(':saldo', $produto->saldo(), PDO::PARAM_STR);
        $update->bindValue(':status', Constantes::ATIVADO, PDO::PARAM_STR);
        return $update->execute();
    }

    private function atualizaNome(Produto $produto): bool
    {
        $update = $this->conexao->prepare('UPDATE produtos SET nome = :nome WHERE id = :id;');
        $update->bindValue(':id', $produto->id(), PDO::PARAM_INT);
        $update->bindValue(':nome', $produto->nome(), PDO::PARAM_STR);
        return $update->execute();
    }

    public function ativa(Produto $produto): bool
    {
        $update = $this->conexao->prepare('UPDATE produtos SET status = :nome WHERE id = :id;');
        $update->bindValue(':id', $produto->id(), PDO::PARAM_INT);
        $update->bindValue(':status', Constantes::ATIVADO, PDO::PARAM_STR);
        return $update->execute();
    }

    public function desativa(Produto $produto): bool
    {
        $update = $this->conexao->prepare('UPDATE produtos SET status = :nome WHERE id = :id;');
        $update->bindValue(':id', $produto->id(), PDO::PARAM_INT);
        $update->bindValue(':status', Constantes::DESATIVADO, PDO::PARAM_STR);
        return $update->execute();
    }

    public function entrada(Produto $produto, Decimal $quantidade): bool
    {
        if ($quantidade <= 0) {
            throw new RuntimeException('A quantidade deve ser um número positivo');
        }
        $update = $this->conexao->prepare('UPDATE produtos SET saldo = :saldo WHERE id = :id;');
        $update->bindValue(':saldo', $produto->saldo() + $quantidade);
        return $update->execute();
    }

    public function saida(Produto $produto, Decimal $quantidade): bool
    {
        if ($quantidade >= 0) {
            throw new RuntimeException('A quantidade deve ser um número negativo');
        }
        if ($produto->saldo() - $quantidade < 0) {
            throw new RuntimeException('Saldo insuficiente');
        }
        $update = $this->conexao->prepare('UPDATE produtos SET saldo = :saldo WHERE id = :id;');
        $update->bindValue(':saldo', $produto->saldo() - $quantidade);
        return $update->execute();
    }

    public function balanco(Produto $produto, Decimal $quantidade): bool
    {
        $update = $this->conexao->prepare('UPDATE produtos SET saldo = :saldo WHERE id = :id;');
        $update->bindValue(':saldo', $produto->saldo() + $quantidade);
        return $update->execute();
    }
}
