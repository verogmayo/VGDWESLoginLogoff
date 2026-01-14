<?php

/**
 * @author: Véro Grué
 * @since: 04/01/2026
 */

// Se comprueba si el botón "volver" ha sido pulsado.
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "cerrar" ha sido pulsado, cierra la session.
if (isset($_REQUEST['cerrar'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Se comprueba si el botón "cambiarPassword" ha sido pulsado.
if (isset($_REQUEST['cambiarPassword'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'cambiarPassword';
    header('Location: indexLoginLogoff.php');
    exit;
}
// Se comprueba si el botón "borrar" ha sido pulsado.
if (isset($_REQUEST['borrarCuenta'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'borrarCuenta';
    header('Location: indexLoginLogoff.php');
    exit;
}
// Se comprueba si el botón "cancelar" ha sido pulsado.
if (isset($_REQUEST['cancelar'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}
$oUsuarioActual = $_SESSION['usuarioVGDAWAppLoginLogoff'];
if (isset($_REQUEST['enviar'])) {
    //Se coge el nuevo nombre
    $nuevoNombre = $_REQUEST['descUsuario'];
    //Se llama al modelo para actualizar el nombre
    $oUsuarioNuevo = UsuarioPDO::modificarUsuario($oUsuarioActual, $nuevoNombre);
    //Se cambia la descrusuario de la session y se vuelve a  inicio privado
    if ($oUsuarioNuevo) {
        $_SESSION['usuarioVGDAWAppLoginLogoff'] = $oUsuarioNuevo;
        $_SESSION['paginaEnCurso'] = 'inicioPrivado';
        header('Location: indexLoginLogoff.php');
        exit;
    }
}
$avCuenta = [
    'codUsuario' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getCodUsuario(),
    'descUsuario' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getDescUsuario(),
    'numAccesos' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getNumAccesos(),
    'fechaHoraUltimaConexionAnterior' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getFechaHoraUltimaConexionAnterior()? $_SESSION['usuarioVGDAWAppLoginLogoff']->getFechaHoraUltimaConexionAnterior()->format('d/m/Y H:i:s'):'Primera Conexión',
    'fechaHoraUltimaConexion' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getFechaHoraUltimaConexion()->format('d/m/Y H:i:s'),
    'perfil' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getPerfil(),
    'imagenUsuario' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getImagenUsuario(),
    'inicial' => $_SESSION['usuarioVGDAWAppLoginLogoff']->getInicial()
];
// cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web
require_once $view['layout'];
