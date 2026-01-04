<?php
/**
* @author: Véro Grué
* @since: 03/01/2026
*/

// Se comprueba si el botón "detalles" ha sido pulsado.
if(isset($_REQUEST['detalles'])){
    $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'detalles';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Se comprueba si el botón "cerrar" ha sido pulsado.
if(isset($_REQUEST['cerrar'])){
    $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Se comprueba si el botón "cuenta" ha sido pulsado.
if(isset($_REQUEST['cuenta'])){
    $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'cuenta';
    header('Location: indexLoginLogoff.php');
    exit;
}

// cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web
require_once $view['layout'];

?>