<?php

namespace Victor\Estoque\Infraestrutura\Repositorios;

use PDO;
use Victor\Estoque\Dominio\Entidades\Cor;
use Victor\Estoque\Dominio\Repositorios\RepositorioCor;

class RepositorioCorPdo implements RepositorioCor
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }
    public function todasAsCores(): array
    {
        return $this->conexao->query('SELECT * FROM cores;')->fetchAll(PDO::FETCH_ASSOC);
    }
    public function todasAsCmyk(): array
    {
        return $this->conexao->query('SELECT * FROM cores WHERE cmyk IS NOT NULL;')->fetchAll(PDO::FETCH_ASSOC);
    }
    public function salvar(Cor &$cor): bool
    {
        if ($cor->id() === null) {
            return $this->inserir($cor);
        }
        return $this->atualizar($cor);
    }
    private function inserir(Cor &$cor): bool
    {
        $inserir = $this->conexao->prepare('INSERT INTO cores (nome) VALUES (:nome);');
        $inserir->bindValue(':nome', $cor->nome(), PDO::PARAM_STR);
        $sucesso = $inserir->execute();
        if ($sucesso) {
            $cor->defineId($this->conexao->lastInsertId());
        }
        return $sucesso;
    }
    private function atualizar(Cor $cor): bool
    {
        $atualizar = $this->conexao->prepare('UPDATE cores SET nome = :nome WHERE id = :id;');
        $atualizar->bindValue(':nome', $cor->nome(), PDO::PARAM_STR);
        $atualizar->bindValue(':id', $cor->id(), PDO::PARAM_INT);
        return $atualizar->execute();
    }
    public function remover(Cor $cor): bool
    {
        $remover = $this->conexao->prepare('DELETE FROM cores WHERE id = :id;');
        $remover->bindValue(':id', $cor->id(), PDO::PARAM_INT);
        return $remover->execute();
    }
}
