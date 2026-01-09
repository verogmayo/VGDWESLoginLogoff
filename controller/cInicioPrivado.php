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
//Se crea un array con los datos del usuario para pasarlos a la vista
$avInicioPrivado=[
    'descUsuario' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getDescUsuario(),
    'numConexiones' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getNumAccesos(),
    'fechaHoraUltimaConexionAnterior' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getFechaHoraUltimaConexionAnterior()
];
//Se cargará la vista y está dispondrá de los datos del usuario en el array $avInicioPrivado

// cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web
require_once $view['layout'];

?>