<?php
/**
 * User: Rafa
 * Date: 10/08/2018
 * Aquí se han de cargar todas las clases que se van a utilizar en el proyecto. Para no cargarlas en todo momento.
 */
$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

include_once('Controller.php');
include_once('Route.php');
