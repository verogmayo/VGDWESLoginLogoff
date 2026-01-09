<?php
/**
* @author: Véro Grué
* @since: 18/12/2025
*/

 
class DBPDO {

    public static function ejecutarConsulta($sentenciaSQL, $aParametros = null) {
        try {
            // Conexión a la base de datos
            $conexion = new PDO(DSN, USUARIODB, PSWD);
            // Configurar el modo errores
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Preparar y ejecutar la consulta
            $consulta = $conexion->prepare($sentenciaSQL);
            $consulta->execute($aParametros);

            return $consulta;
        }catch (PDOException $e) {
            $_SESSION['paginaAnterior']=$_SESSION['paginaEnCurso'];
            $_SESSION['paginaEnCurso']='error';
            $_SESSION['error']=
            throw new Exception("Error BD: " . $e->getMessage());
        }

    }
}
?>