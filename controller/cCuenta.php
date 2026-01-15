<?php

/**
 * @author: Véro Grué
 * @since: 14/01/2026
 */
//Si no se iniciado session, se redirige a la pagina de inicio publico
if (empty($_SESSION['usuarioVGDAWAppLoginLogoff'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

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
//Objeto de usuario de la sesión
$oUsuarioActual = $_SESSION['usuarioVGDAWAppLoginLogoff'];

$aErrores = [
    'descUsuario' => null
];


$entradaOK = true;

// Se Comprobueba si se ha pulsado el botón enviar
if (isset($_REQUEST['enviar'])) {
    // Validar desde la libreria
    $aErrores['descUsuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['descUsuario'], 255, 1, 1);
    
    // Si hay algún error, entradaOK false
    foreach ($aErrores as $error) {
        if ($error != null) {
            $entradaOK = false;
        }
    }
} else {
    // Si no se ha pulsado enviar
    $entradaOK = false;
}

// Si todo es correcto
if ($entradaOK) {
    
    $nuevoNombre = $_REQUEST['descUsuario'];
    
    // Llamada al modelo para actualizar
    $oUsuarioNuevo = UsuarioPDO::modificarUsuario($oUsuarioActual, $nuevoNombre);
    
    if ($oUsuarioNuevo) {
        // Actualizaar la sesión con el nuevo objeto
        $_SESSION['usuarioVGDAWAppLoginLogoff'] = $oUsuarioNuevo;
        
        // Redirigir al inicio privado
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
