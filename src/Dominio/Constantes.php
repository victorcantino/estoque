<?php

namespace Victor\Estoque\Dominio;

use DateTimeZone;
use DateTimeImmutable;

class Constantes
{
    const ATIVADO = 'ATIVADO';
    const DESATIVADO = 'DESATIVADO';

    public static function agora(): string
    {
        $now = new DateTimeImmutable('now', new DateTimeZone("America/Sao_Paulo"));
        return $now->format('Y-m-d H:i:s');
    }
}
