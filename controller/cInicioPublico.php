<?php
/**
* @author: Véro Grué
* @since: 15/12/2025
*/

//Si se pulsa el boton de login
if(isset($_REQUEST['login'])){
     $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'] ;
    //La pagina en curso es la pagina de login
    $_SESSION['paginaEnCurso'] = 'login';
    header('Location: indexLoginLogoff.php');
    exit;
}

// cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web
require_once $view['layout'];
?>
