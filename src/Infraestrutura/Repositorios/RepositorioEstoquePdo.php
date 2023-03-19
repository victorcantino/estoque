<?php

namespace Victor\Estoque\Infraestrutura\Repositorios;

use PDO;
use Victor\Estoque\Dominio\Constantes;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Dominio\Repositorios\RepositorioEstoque;

class RepositorioEstoquePdo implements RepositorioEstoque
{
    public function __construct(
        private PDO $conexao
    ) {
    }

    public function todos(): array
    {
        $sql = 'SELECT id, nome, status FROM estoques ORDER BY LOWER(nome) ASC;';
        return $this->mapearLista($this->conexao->query($sql)->fetchAll());
    }

    private function mapearLista(array $estoques): ?array
    {
        return array_map(function (array $dados) {
            return new Estoque(...$dados);
        }, $estoques);
    }

    private function mapearObjeto(array $estoque): Estoque
    {
        return new Estoque(...array_values($estoque));
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
        $inserir->bindValue(':status', Constantes::ATIVADO);
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
        $estoque = $this->mapearObjeto($recuperar->fetch());
        return $estoque !== false ? $estoque : null;
    }

    public function apaga(int $id): bool
    {
        $sql = <<<APAGA
        UPDATE estoques
        SET status = :status, atualizadoEm = :atualizadoEm
        WHERE id = :id;
        APAGA;
        $apagar = $this->conexao->prepare($sql);
        $apagar->bindValue(':id', $id);
        $apagar->bindValue(':status', Constantes::DESATIVADO);
        $apagar->bindValue(':atualizadoEm', Constantes::agora());
        return $apagar->execute();
    }

    public function filtra(?string $nome, ?string $status): ?array
    {
        $sql = "SELECT id, nome, status FROM estoques WHERE 1=1";
        $params = [];

        if ($nome !== null) {
            $sql .= " AND nome LIKE :nome";
            $params[':nome'] = '%' . $nome . '%';
        }

        if ($status !== null) {
            $sql .= " AND status LIKE :status";
            $params[':status'] = '%' . $status . '%';
        }

        $filtrar = $this->conexao->prepare($sql);
        $filtrar->execute($params);
        return $this->mapearLista($filtrar->fetchAll());
    }
}
