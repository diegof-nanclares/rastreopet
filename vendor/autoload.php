<?php

// Registramos el autoloader de la aplicación
spl_autoload_register(function ($className) {

    $classPath = str_replace('\\', '/', $className);
    if($classPath == "Controllers/LibController"){
      return;
    }

    $file = "../app/$classPath.php";

    if (file_exists($file)) {
        require_once $file;
    } else {
        header("HTTP/1.0 404 Not Found");
        header("Location: /page404");
    }

    require_once  "../app/$classPath.php";
});
