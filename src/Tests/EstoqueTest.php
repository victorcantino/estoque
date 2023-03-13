<?php

namespace Victor\Estoque\Tests;

use PHPUnit\Framework\TestCase;
use Victor\Estoque\Dominio\Entidades\Estoque;
use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioEstoquePdo;

class EstoqueTest extends TestCase
{
    public function testCriarTabela()
    {
        $sql = <<<CRIARTABELA
        DROP TABLE IF EXISTS estoques;
        CREATE TABLE estoques (
            id INTEGER PRIMARY KEY,
            nome TEXT,
            status TEXT DEFAULT 'ATIVO'
        );
        CRIARTABELA;

        $this->assertEquals(0, CriadorDeConexao::criarConexao()->exec($sql));
    }
    public function testInserir()
    {
        $estoque = new Estoque(null, 'Hack Print');
        $repo = new RepositorioEstoquePdo(CriadorDeConexao::criarConexao());
        $this->assertEquals(TRUE, $repo->salva($estoque));
    }
    public function testAlterar()
    {
        $estoque = new Estoque(1, 'Ecopulse');
        $repo = new RepositorioestoquePdo(CriadorDeConexao::criarConexao());
        $this->assertEquals(TRUE, $repo->salva($estoque));
    }
    public function testPesquisar()
    {
        $estoque = new Estoque(1, 'Hack Print');
        $repo = new RepositorioestoquePdo(CriadorDeConexao::criarConexao());
        $this->assertEquals(TRUE, $repo->estoques());
    }
}
