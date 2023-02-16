<?php

namespace hackprint\estoque\classes\controle;

use hackprint\estoque\classes\modelo\Item;

class ControleEstoque
{
    private array $itens = [];

    public function entrada(Item $item): void
    {
        if (!$this->itemExiste($item)) {
            $this->itens[$item->descricao] = 0; // cria o item com o estoque zerado
        }
        $this->itens[$item->descricao] += $item->quantidade; // adiciona a quantidade
    }

    public function saida(Item $item): void
    {
        if (!$this->itemExiste($item)) {
            return;
        }
        if (!$this->temSaldo($item)) {
            return;
        }
        $this->itens[$item->descricao] -= $item->quantidade;
    }

    public function recuperaSaldo(Item $item): float
    {
        if ($this->itemExiste($item)) {
            return $this->itens[$item->descricao];
        }
        return 0;
    }

    private function itemExiste(Item $item): bool
    {
        if (key_exists($item->descricao, $this->itens)) {
            return true;
        }
        return false;
    }

    private function temSaldo(Item $item): bool
    {
        if ($this->recuperaSaldo($item) > $item->quantidade) {
            return true;
        }
        return false;
    }
}
