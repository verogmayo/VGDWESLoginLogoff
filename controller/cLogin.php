<?php

/**
 * @author: Véro Grué
 * @since: 03/01/2026
 */

// Si se hace clic en el botón volver no sigue y redirige a la página de inicio
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Si se hace clic en el botón crear cuenta no sigue y redirige a la página de registro
if (isset($_REQUEST['crearCuenta'])) {
    $_SESSION['paginaEnCurso'] = 'registro';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Arrays para errores y respuestas
$aErrores = [
    'codUsuario' => null,
    'password' => null
];

$aRespuestas = [
    'codUsuario' => '',
    'password' => ''
];

// Variable para controlar si la entrada es correcta
$entradaOK = true;



//  Validación y login del boton enviar
if (isset($_REQUEST['enviar'])) {

    // Guardar página anterior
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];

    // Validar los campos del formulario
    $aErrores['codUsuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['codUsuario'], 255, 0, 0);
    $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], 20, 2, 1, 1);


    // Verificar si hay errores de validación
    foreach ($aErrores as $valorCampo => $msjError) {
        if ($msjError != null) {
            $entradaOK = false;
        }
    }


    if ($entradaOK) {
        $oUsuario = UsuarioPDO::validarUsuario($_REQUEST['codUsuario'], $_REQUEST['password']);
        // si no esta en la base de datos entrada ok false
        if (!isset($oUsuario)) {
            $entradaOK = false;
        }
    }
} else {
    // Si no se ha enviado el formulario
    $entradaOK = false;

    $oUsuario = UsuarioPDO::actualizarUltimaConexion($oUsuario);
    // Login correcto, se crea el usuario en la sesión
    $_SESSION['usuarioVGDAWAppLoginLogoff'] = $oUsuario;

    // Se saca la inicial del usuario aqui para poder utilizarla en el boton de cuenta.
    // Se saca el nombre del usuario.
    $nombre = $oUsuario->getDescUsuario();
    //Se saca la inicial. https://www.php.net/manual/fr/function.mb-strtoupper.php  (caracteres en mayúsculas)
    //https://www.php.net/manual/fr/function.mb-strtoupper.php (primer caracter)
    $_SESSION['inicialVGDAW'] = mb_strtoupper(mb_substr($nombre, 0, 1));

    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Si hay errores o no se ha enviado, cargar el layout con el formulario
require_once $view['layout'];
