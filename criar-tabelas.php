<?php

require_once 'vendor/autoload.php';

use Victor\Estoque\Infraestrutura\Persistencia\CriadorDeConexao;

$cores = CriadorDeConexao::criarConexao()->exec('CREATE TABLE cores (id INTEGER PRIMARY KEY, nome TEXT, cmyk TEXT);');
