<?php
spl_autoload_register(function ($namespace) {
  $namespace = str_replace('Admin\\', "", $namespace);
  
  $partes = explode('\\', $namespace);
  
  $partes = array_map(function ($parte) {
    return lcfirst($parte);
    }, $partes);
    
    $namespace = implode(DIRECTORY_SEPARATOR, $partes);
    $arquivo = __DIR__ . DIRECTORY_SEPARATOR . $namespace . '.php';
    
  if (file_exists($arquivo)) {
    require_once $arquivo;
    return true;
  }
  return false;
});