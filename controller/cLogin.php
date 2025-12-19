<?php
/**
* @author: Véro Grué
* @since: 18/12/2025
*/




// Arrays para errores y respuestas
$aErrores = [
    'usuario' => null,
    'password' => null
];

$aRespuestas = [
    'usuario' => '',
    'password' => ''
];

// Variable para controlar si la entrada es correcta
$entradaOK = true;

// Se comprueba primero el botn volver
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

//  Validación y login del boton enviar
if (isset($_REQUEST['enviar'])) {
    
    // Guardar página anterior
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    
    // Validar los campos del formulario
    $aErrores['usuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 255, 0, 0);
    $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], 20, 2, 1, 1);
    
    // Guardar las respuestas para rellenar el formulario si hay algun error
    $aRespuestas['usuario'] = $_REQUEST['usuario'];
    $aRespuestas['password'] = $_REQUEST['password'];
    
    // Verificar si hay errores de validación
    foreach ($aErrores as $valorCampo=>$msjError) {
        if ($msjError !=null) {
            $entradaOK = false;
        }
    }
    
    // Si la validación es correcta, validar con la BD
    if ($entradaOK) {
        $oUsuario = UsuarioPDO::validarUsuario($_REQUEST['usuario'], $_REQUEST['password']);

        
        if ($oUsuario === null) {
            $entradaOK = false;
        } else {
            // Login correcto
            $_SESSION['usuarioVGDAWAppLoginLogoff'] = $oUsuario;
            $_SESSION['paginaEnCurso'] = 'inicioPrivado';
            header('Location: indexLoginLogoff.php');
            exit;
        }
    }
    
} else {
    // Si no se ha enviado el formulario
    $entradaOK = false;
}

// Si hay errores o no se ha enviado, cargar el layout con el formulario
require_once $view['layout'];


?>