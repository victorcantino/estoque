<?php

require_once 'autoload.php';

use hackprint\estoque\classes\controle\ControleEstoque;
use hackprint\estoque\classes\modelo\Item;

$estoque = new ControleEstoque();
$estoque->entrada(new Item('Fita Poliéster 15mm', 2000));
$estoque->entrada(new Item('Fita Poliéster 20mm', 2000));
$estoque->entrada(new Item('Fita Poliéster 25mm', 2000));

$estoque->saida(new Item('Fita Poliéster 15mm', 750));
$estoque->saida(new Item('Fita Poliéster 20mm', 500));
$estoque->saida(new Item('Fita Poliéster 25mm', 250));
$estoque->saida(new Item('Fita Poliéster 25mm', 2000)); // excede o estoque
$estoque->saida(new Item('Fita Poliéster 35mm', 250)); // não foi cadastrado
