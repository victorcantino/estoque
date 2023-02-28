<?php

namespace Victor\Estoque\Controle;

use Victor\Estoque\Modelo\Item;

class ControleEstoque
{
    public array $itens = [];

    public function entrada(Item $item): void
    {
        if (!$this->itemExiste($item)) {
            $this->itens[$item->recuperaNome()] = 0; // cria o item com o estoque zerado
        }
        $this->itens[$item->recuperaNome()] += $item->recuperaQuantidade(); // adiciona a quantidade
    }

    public function saida(Item $item): void
    {
        if (!$this->itemExiste($item)) {
            return;
        }
        if (!$this->temSaldo($item)) {
            return;
        }
        $this->itens[$item->recuperaNome()] -= $item->recuperaQuantidade();
    }

    public function recuperaSaldo(Item $item): float
    {
        if ($this->itemExiste($item)) {
            return $this->itens[$item->recuperaNome()];
        }
        return 0;
    }

    private function itemExiste(Item $item): bool
    {
        if (key_exists($item->recuperaNome(), $this->itens)) {
            return true;
        }
        return false;
    }

    private function temSaldo(Item $item): bool
    {
        if ($this->recuperaSaldo($item) > $item->recuperaQuantidade()) {
            return true;
        }
        return false;
    }
}
