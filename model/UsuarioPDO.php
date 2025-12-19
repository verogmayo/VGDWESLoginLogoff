<?php

/**
 * @author: Véro Grué
 * @since: 18/12/2025
 */
require_once 'DBPDO.php';
require_once 'Usuario.php';

class UsuarioPDO
{

    /**
     * Valida las credenciales de un usuario y devuelve un objeto Usuario si son correctas
     * @param string $codUsuario Código del usuario
     * @param string $password Contraseña sin encriptar
     * @return Usuario|null Objeto Usuario si las credenciales son correctas, null si no
     */
    public static function validarUsuario($codUsuario, $password)
    {

        // Consulta SQL para validar usuario
        $sql = <<<SQL
            SELECT
                T01_CodUsuario,
                T01_Password,
                T01_DescUsuario,
                T01_FechaHoraUltimaConexion,
                T01_NumConexiones,
                T01_Perfil,
                T01_ImagenUsuario
            FROM T01_Usuario
            WHERE T01_CodUsuario = :usuario
              AND T01_Password = SHA2(:password, 256)
        SQL;

        try {
            // Ejecutar la consulta
            $consulta = DBPDO::ejecutarConsulta($sql, [
                ':usuario'  => $codUsuario,
                ':password' => $codUsuario . $password
            ]);

            // Obtener el resultado
            $usuarioDB = $consulta->fetch(PDO::FETCH_ASSOC);

            // Si no existe el usuario o la contraseña es incorrecta
            if (!$usuarioDB) {
                return null;
            }
            
            //Se convierte la fecha en datetime
            $fechaBD = $usuarioDB['T01_FechaHoraUltimaConexion'];
            $oFechaValida = ($fechaBD) ? new DateTime($fechaBD) : null;
            // Crear el objeto Usuario con los datos de la BD
            $oUsuario = new Usuario(
                $usuarioDB['T01_CodUsuario'],
                $usuarioDB['T01_Password'],
                $usuarioDB['T01_DescUsuario'],
                $usuarioDB['T01_NumConexiones'],
                $oFechaValida,
                null,                                         // fechaHoraUltimaConexionAnterior (empezamos en null)
                $usuarioDB['T01_Perfil'],
                $usuarioDB['T01_ImagenUsuario']
            );

            // Actualizar la última conexión en la BD y en el objeto
            self::actualizarUltimaConexion($oUsuario);

            return $oUsuario;
        } catch (Exception $e) {
            // En caso de error, devolver null
            return null;
        }
    }

    /**
     * Actualiza la fecha de última conexión y el contador de accesos
     * @param Usuario $oUsuario Objeto usuario a actualizar
     */
    private static function actualizarUltimaConexion($oUsuario)
    {

        // SQL para actualizar los datos de conexión
        $sql = <<<SQL
            UPDATE T01_Usuario SET
                T01_FechaHoraUltimaConexion = NOW(),
                T01_NumConexiones = T01_NumConexiones + 1
            WHERE T01_CodUsuario = :usuario
        SQL;


        // Ejecutar la actualización en la BD
        DBPDO::ejecutarConsulta($sql, [
            ':usuario' => $oUsuario->getCodUsuario()
        ]);

        // Actualizar el objeto Usuario en memoria
        // La fecha actual que tenía ahora pasa a ser la anterior
        $oUsuario->setFechaHoraUltimaConexionAnterior($oUsuario->getFechaHoraUltimaConexion());

        // Incrementar el número de accesos
        $oUsuario->setNumAccesos($oUsuario->getNumAccesos() + 1);

        // Establecer la nueva fecha de conexión (ahora)
        date_default_timezone_set('Europe/Madrid');
        $oUsuario->setFechaHoraUltimaConexion(new DateTime());
    }
}
