<?php
/**
* @author: Véro Grué
* @since: 04/01/2026
*/

// Se comprueba si el botón "volver" ha sido pulsado.
if(isset($_REQUEST['volver'])){
     $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "cerrar" ha sido pulsado, cierra la session.
if(isset($_REQUEST['cerrar'])){
    $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Se comprueba si el botón "cambiarPassword" ha sido pulsado.
if(isset($_REQUEST['cambiarPassword'])){
    $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'cambiarPassword';
    header('Location: indexLoginLogoff.php');
    exit;
}
// Se comprueba si el botón "borrar" ha sido pulsado.
if(isset($_REQUEST['borrarCuenta'])){
    $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'borrarCuenta';
    header('Location: indexLoginLogoff.php');
    exit;
}
$avCuenta = [
    'codUsuario' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getCodUsuario(),
    'descUsuario' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getDescUsuario(),
    'numAccesos' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getNumAccesos(),
    'fechaHoraUltimaConexionAnterior' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getFechaHoraUltimaConexionAnterior(),
    'fechaHoraUltimaConexion' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getFechaHoraUltimaConexion(),
    'perfil' =>$_SESSION['usuarioVGDAWAppLoginLogoff']->getPerfil(),
    'imagenUsuario' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getImagenUsuario(),
    'inicial' => $_SESSION['inicialVGDAW']
];
// cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web
require_once $view['layout'];

?>