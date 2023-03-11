<?php

namespace Victor\Estoque\Infraestrutura\Repositorios;

use Constantes;
use PDO;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Dominio\Entidades\Status;
use Victor\Produto\Dominio\Repositorios\InterfaceStatus;
use Victor\Produto\Dominio\Repositorios\RepositorioEstoque;

class RepositorioEstoquePdo implements RepositorioEstoque
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function estoques(): array
    {
        return $this->conexao->query('SELECT * FROM estoques;')->fetchAll();
    }

    public function salva(Estoque $estoque): bool
    {
        if ($estoque->id() === null) {
            return $this->novo($estoque);
        }
        return $this->atualizaNome($estoque);
    }

    private function atualizaNome(Estoque $estoque): bool
    {
        $atualizar = $this->conexao->prepare('UPDATE estoques SET nome = :nome WHERE id = :id;');
        $atualizar->bindValue(':id', $estoque->id(), PDO::PARAM_INT);
        $atualizar->bindValue(':nome', $estoque->nome(), PDO::PARAM_STR);
        return $atualizar->execute();
    }

    private function novo(Estoque $estoque): bool
    {
        $inserir = $this->conexao->prepare('INSERT INTO estoques (nome) VALUES (:nome);');
        $inserir->bindValue(':nome', $estoque->nome(), PDO::PARAM_STR);
        $sucesso = $inserir->execute();
        if ($sucesso) {
            $estoque->atualizaId($this->conexao->lastInsertId());
        }
        return $sucesso;
    }

    // public function ativa(Estoque $objeto): bool
    // {
    //     $update = $this->conexao->prepare('UPDATE estoques SET status = :status WHERE id = :id;');
    //     $update->bindValue(':id', $objeto->id(), PDO::PARAM_INT);
    //     $update->bindValue(':status', Constantes::ATIVADO, PDO::PARAM_STR);
    //     return $update->execute();
    // }

    // public function desativa(Estoque $estoque): bool
    // {
    //     $update = $this->conexao->prepare('UPDATE estoques SET status = :status WHERE id = :id;');
    //     $update->bindValue(':id', $estoque->id(), PDO::PARAM_INT);
    //     $update->bindValue(':status', Constantes::DESATIVADO, PDO::PARAM_STR);
    //     return $update->execute();
    // }
}
