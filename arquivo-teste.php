<?php

use Victor\Estoque\Controle\ControleEstoque;

require_once 'vendor/autoload.php';

$controle = new ControleEstoque();
$controle->entrada(new Item(new Produto("Fita Poliéster 25mm", 25, 1000, null, null, new Cor("Branco", null)), 2000));
$controle->entrada(new Item(new Produto("Fita Poliéster 20mm", 20, 1000, null, null, new Cor("Branco", null)), 2000));
$controle->entrada(new Item(new Produto("Fita Poliéster 15mm", 15, 1000, null, null, new Cor("Branco", null)), 2000));

$controle->saida(new Item(new Produto("Fita Poliéster 25mm", 25, 1000, null, null, new Cor("Branco", null)), 1000));

var_dump($controle);