<?php
/**
* @author: Véro Grué
* @since: 16/12/2025
*/

// Se comprueba si el botón "volver" ha sido pulsado.
if(isset($_REQUEST['volver'])){
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
   // $_SESSION['paginaAnterior'] ='detalles';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "cerrar" ha sido pulsado, cierra la session.
if(isset($_REQUEST['cerrar'])){
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
   // $_SESSION['paginaAnterior'] ='detalles';
    header('Location: indexLoginLogoff.php');
    exit;
}
// cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web
require_once $view['layout'];

?>