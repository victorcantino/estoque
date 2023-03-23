<?php

namespace Victor\Estoque\Infraestrutura\Repositorios;

use PDO;
use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Dominio\Repositorios\RepositorioBase;
use Victor\Estoque\Dominio\Repositorios\RepositorioEstoque;

class RepositorioEstoquePdo extends RepositorioBase implements RepositorioEstoque
{
    public function __construct(
        private PDO $conexao
    ) {
    }

    public function todos(): array
    {
        $sql = 'SELECT id, nome, status FROM estoques ORDER BY id ASC;';
        return $this->mapearLista($this->conexao->query($sql)->fetchAll(), Estoque::class);
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
        $sql = 'UPDATE estoques SET nome = :nome, status = :status, atualizadoEm = :atualizadoEm WHERE id = :id;';
        $atualizar = $this->conexao->prepare($sql);
        $atualizar->bindValue(':id', $estoque->getId(), PDO::PARAM_INT);
        $atualizar->bindValue(':nome', $estoque->getNome());
        $atualizar->bindValue(':status', $estoque->getStatus());
        $atualizar->bindValue(':atualizadoEm', Constantes::agora());
        return $atualizar->execute();
    }

    public function recupera(int $id): ?Estoque
    {
        $sql = 'SELECT id, nome, status FROM estoques WHERE id = :id;';
        $recuperar = $this->conexao->query($sql);
        $recuperar->bindValue(':id', $id, PDO::PARAM_INT);
        $recuperar->execute();
        $estoque = $this->mapearObjeto($recuperar->fetch(), Estoque::class);
        return $estoque !== false ? $estoque : null;
    }

    public function apaga(int $id): bool
    {
        $sql = 'DELETE FROM estoques WHERE id = :id;';
        $apagar = $this->conexao->prepare($sql);
        $apagar->bindValue(':id', $id, PDO::PARAM_INT);
        return $apagar->execute();
    }

    public function ativa(int $id): bool
    {
        $sql = 'UPDATE estoques SET status = :status, atualizadoEm = :atualizadoEm WHERE id = :id;';
        $apagar = $this->conexao->prepare($sql);
        $apagar->bindValue(':id', $id);
        $apagar->bindValue(':status', Constantes::ATIVADO);
        $apagar->bindValue(':atualizadoEm', Constantes::agora());
        return $apagar->execute();
    }

    public function desativa(int $id): bool
    {
        $sql = 'UPDATE estoques SET status = :status, atualizadoEm = :atualizadoEm WHERE id = :id;';
        $apagar = $this->conexao->prepare($sql);
        $apagar->bindValue(':id', $id);
        $apagar->bindValue(':status', Constantes::DESATIVADO);
        $apagar->bindValue(':atualizadoEm', Constantes::agora());
        return $apagar->execute();
    }

    public function filtra(?string $nome, ?string $status, ?string $ordem): ?array
    {
        $sql = 'SELECT id, nome, status FROM estoques WHERE 1=1';
        $params = [];

        if ($nome !== null) {
            $sql .= ' AND nome LIKE :nome';
            $params[':nome'] = '%' . $nome . '%';
        }

        if ($status !== null) {
            $sql .= ' AND status = :status';
            $params[':status'] = $status;
        }

        if ($ordem !== null) {
            $sql .= ' ORDER BY LOWER(' . $ordem . ')';
        }

        $filtrar = $this->conexao->prepare($sql);
        $filtrar->execute($params);
        return $this->mapearLista($filtrar->fetchAll(), Estoque::class);
    }
}
