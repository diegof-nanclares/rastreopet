<?php
/**
 * @author Diego Salazar
 * Here's the autoload and run for the app
 * Rastreo Pet 2023
 */
 
date_default_timezone_set('America/Bogota');
setlocale(LC_TIME, 'es_ES');
require_once __DIR__ . '/../vendor/autoload.php';
$config =  require __DIR__ . '/../config/config.php';

// Create an instance of the application
$app = new Core\App($config);
// Run App!!
$app->run();
?>
