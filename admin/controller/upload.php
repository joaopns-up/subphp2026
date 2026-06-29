<?php
/**
 * Não tem erros por aqui.
 */
namespace Admin\Controller;
use \Exception;
class Upload {
    private const TAMANHO_MAXIMO = 1024 * 1024 * 10; // 10MB

    public static function uploadImagem($imagem, $diretorio): string {  
        if (!self::validarImagem($imagem)) throw new Exception("Erro ao fazer o upload da imagem");

        $nomeFinal = uniqid() . "." . pathinfo($imagem["name"], PATHINFO_EXTENSION);
        $caminhoCompleto = "img/" . $diretorio . "/" . $nomeFinal;

        if (move_uploaded_file($imagem["tmp_name"],  "../assets/". $caminhoCompleto)) return $caminhoCompleto;
        
        throw new Exception("Erro ao realizar o Upload");
    }

    private static function validarImagem($imagem): bool {
        if ($imagem["error"] != 0) {
            return false;
        }

        if ($imagem["size"] > self::TAMANHO_MAXIMO) { 
            return false;
        }

        $tiposValidos = ["image/jpeg", "image/png", "image/gif"];
        if (!in_array($imagem["type"], $tiposValidos)) {
            return false;
        }

        return true;
    }

    public static function excluirImagem($caminhoImagem) {
        unlink($caminhoImagem);
    }
}