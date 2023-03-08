<?php

namespace Victor\Estoque\Tests;

use PDO;
use PHPUnit\Framework\TestCase;
use Victor\Estoque\Dominio\Entidades\Cor;
use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;
use Victor\Estoque\Infraestrutura\Repositorios\RepositorioCorPdo;

class CorTest extends TestCase
{
    public function testCriarTabela()
    {
        $sql = <<<CRIARTABELA
        DROP TABLE IF EXISTS cores;
        CREATE TABLE cores (
            id INTEGER PRIMARY KEY, 
            nome TEXT, 
            ciano REAL, 
            magenta REAL, 
            amarelo REAL, 
            preto REAL, 
            vermelho INTEGER, 
            verde INTEGER,
            azul INTEGER
        ); 
        CRIARTABELA;

        $this->assertEquals(0, CriadorDeConexao::criarConexao()->exec($sql));
    }
    public function testInserir()
    {
        $cor = new Cor(null, 'Branco');
        $repo = new RepositorioCorPdo(CriadorDeConexao::criarConexao());
        $this->assertEquals(1, $repo->salvar($cor));
    }
    public function testAlterar()
    {
        $cor = new Cor(1, 'Preto');
        $repo = new RepositorioCorPdo(CriadorDeConexao::criarConexao());
        $this->assertEquals(1, $repo->salvar($cor));
    }
    public function testRemover()
    {
        $cor = new Cor(1, 'Preto');
        $repo = new RepositorioCorPdo(CriadorDeConexao::criarConexao());
        $this->assertEquals(TRUE, $repo->remover($cor));
    }
}
