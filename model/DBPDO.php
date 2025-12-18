<?php
/**
* @author: Véro Grué
* @since: 18/12/2025
*/

require_once __DIR__ . '/../config/confDBPDO.php';
class DBPDO {

    public static function ejecutarConsulta($sentenciaSQL, $getConexion = null) {
        try {
       $conexion = new PDO(DSN, USERNAME, PASSWORD);
            // Para que los errores se vean claros
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consulta = $conexion->prepare($sql);
            $consulta->execute($parametros);
            $usuarioDB = $consulta->fetch();
            return $usuarioDB;
    }

    }
}
?>