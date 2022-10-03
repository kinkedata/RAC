<?php

function logger_php_autoload($class){
    // prefijo del namespace del proyecto
    $prefix = 'Logger\\';

    // directorio base para las clases
    $base_dir = dirname(__FILE__) . '/';

    // ¿se esta registrando el prefijo de nuestra clase?
    // si no que salga del autoloader
    $len = strlen($prefix);
    if(strncmp($prefix, $class, $len) !== 0)
        return;

    // obtenemos la clase solicitada sin nuestro prefijo
    $relative_class = substr($class, $len);

    // obtenemos el directorio de la clase solicitada
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // si existe el archivo lo importamos
    if(file_exists($file))
        require $file;
}

spl_autoload_register('logger_php_autoload');

?>