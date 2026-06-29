<?php
namespace Admin\Util;

class Functions {
    
static function prepararTexto($texto) {
    return trim(htmlentities($texto));
}

}