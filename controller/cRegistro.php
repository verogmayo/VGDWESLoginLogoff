<?php
/**
* @author: Véro Grué
* @since: 03/01/2025
*/

// Si se hace clic en el botón volver no sigue y redirige al login
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'login';
    header('Location: indexLoginLogoff.php');
    exit;
}



// Arrays para errores y respuestas
$aErrores = [
    'usuario' => null,
    'password' => null,
    'nombreCompleto' => null
];

$aRespuestas = [
    'usuario' => '',
    'password' => '',
    'nombreCompleto' => ''
];

// Variable para controlar si la entrada es correcta
$entradaOK = true;



//  Validación y login del boton enviar
if (isset($_REQUEST['enviar'])) {
    
    // Guardar página anterior
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    
    // Validar los campos del formulario
    $aErrores['usuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 8, 4, 1);
    $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], 8, 4, 1, 1);
    $aErrores['nombreCompleto'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['nombreCompleto'], 255, 4, 1);

    // Guardar las respuestas para rellenar el formulario si hay algun error
    $aRespuestas['usuario'] = $_REQUEST['usuario'];
    $aRespuestas['password'] = $_REQUEST['password'];
    $aRespuestas['nombreCompleto'] = $_REQUEST['nombreCompleto'];
        
    // Verificar si hay errores de validación
    foreach ($aErrores as $valorCampo=>$msjError) {
        if ($msjError !=null) {
            $entradaOK = false;
        }
    }
    
    // Si la validación es correcta, validar con la BD
    if ($entradaOK) {
        // Se comprueba si el código de usuario ya existe
        if (UsuarioPDO::validarCodigoNoExiste($_REQUEST['usuario'])) {
            $aErrores['usuario'] = "El nombre de usuario ya existe.";
            $entradaOK = false;
        } else {
            // Si no existe, se crea el nuevo usuario
            $oUsuario = UsuarioPDO::crearUsuario(
                $_REQUEST['usuario'], 
                $_REQUEST['password'], 
                $_REQUEST['nombreCompleto']
            );

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
    } 
} else {
    // Si no se ha enviado el formulario
    $entradaOK = false;
}

// Si hay errores o no se ha enviado, cargar el layout con el formulario
require_once $view['layout'];


?>