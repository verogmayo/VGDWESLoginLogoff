<?php

/**
 * @author: Véro Grué
 * @since: 15/12/2025
 */

require_once 'core/libreriaValidacion.php';
require_once 'core/miLibreriaStatic.php';
require_once 'config/confDBPDODes.php';

$controller = [
  'inicioPublico' => 'controller/cInicioPublico.php',
  'login' => 'controller/cLogin.php',
  'inicioPrivado' => 'controller/cInicioPrivado.php',
  'detalles' => 'controller/cDetalles.php'
];

$view = [
  'inicioPublico' => 'view/vInicioPublico.php',
  'layout' => 'view/layout.php',
  'login' => 'view/vLogin.php',
  'inicioPrivado' => 'view/vInicioPrivado.php',
  'detalles' => 'view/vDetalles.php'
];
?>

