<?php
/**
 * CARREGA TODOS OS ARQUIVOS NECESSÁRIOS
 */
spl_autoload_register(function (string $nomeCompletoDaClasse) {
    $caminhoArquivo = str_replace('hackprint\\estoque', 'src', $nomeCompletoDaClasse);
    $caminhoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoArquivo);
    $caminhoArquivo .= '.php';

    if (file_exists($caminhoArquivo)) {
        require_once $caminhoArquivo;
    }
});
