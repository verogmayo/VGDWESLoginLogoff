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
                null,                                         // fechaHoraUltimaConexionAnterior (empieza en null)
                $usuarioDB['T01_Perfil'],
                $usuarioDB['T01_ImagenUsuario']
            );

           

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
    public static function actualizarUltimaConexion($oUsuario)
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

    /**
     * Crea un nuevo usuario en la base de datos
     * @param string $codUsuario
     * @param string $password
     * @param string $descUsuario
     * @return Usuario|null El objeto usuario si se crea con éxito, null si falla
     */
    public static function crearUsuario($codUsuario, $password, $descUsuario)
    {
        $oUsuario = null;

        // SQL para insertar el nuevo registro
        // El perfil por defecto debe ser 'usuario'
        $sql = <<<SQL
            INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario, T01_Perfil) 
            VALUES (:usuario, SHA2(:password, 256), :descripcion, 'usuario')
        SQL;

        try {
            $consulta = DBPDO::ejecutarConsulta($sql, [
                ':usuario' => $codUsuario,
                ':password' => $codUsuario . $password,
                ':descripcion' => $descUsuario
            ]);

            if ($consulta) {
                // Si la inserción tiene éxito, se valida al usuario para obtener el objeto completo
                // (y se rellena las fechas iniciales y el número de conexiones)
                $oUsuario = self::validarUsuario($codUsuario, $password);
            }
        } catch (Exception $e) {
            return null;
        }

        return $oUsuario;
    }

    /**
     * Comprueba si un código de usuario ya existe en la BD
     * @param string $codUsuario
     * @return boolean true si existe, false si no
     */
    public static function validarCodigoNoExiste($codUsuario)
    {
        $existe = false;
        $sql = "SELECT T01_CodUsuario FROM T01_Usuario WHERE T01_CodUsuario = :usuario";

        try {
            //si la consulta devuelve alguna fila es que el codigo ya existe
            $consulta = DBPDO::ejecutarConsulta($sql, [':usuario' => $codUsuario]);
            if ($consulta->rowCount() > 0) {
                $existe = true;
            }
        } catch (Exception $e) {
            $existe = false;
        }
        return $existe;
    }

    /**
     * Cambia la contraseña de un usuario existente
     * @param Usuario $oUsuario Objeto del usuario actual
     * @param string $nuevaPassword Nueva contraseña sin encriptar
     * @return Usuario|null El objeto usuario actualizado o null si falla
     */
    public static function cambiarPassword($oUsuario, $nuevaPassword)
    {
        $sql = <<<SQL
        UPDATE T01_Usuario SET 
            T01_Password = SHA2(:password, 256)
        WHERE T01_CodUsuario = :usuario
    SQL;

        try {
            $consulta = DBPDO::ejecutarConsulta($sql, [
                ':usuario' => $oUsuario->getCodUsuario(),
                ':password' => $oUsuario->getCodUsuario() . $nuevaPassword
            ]);

            if ($consulta) {
                // Se actualiza la contraseña en el objeto existente para que coincida con la BD
                $oUsuario->setPassword(hash('sha256', $oUsuario->getCodUsuario() . $nuevaPassword));
                return $oUsuario;
            }
        } catch (Exception $e) {
            return null;
        }
        return null;
    }

    /**
     * Elimina un usuario de la base de datos
     * @param Usuario $oUsuario Objeto del usuario a eliminar
     * @return boolean True si se borró correctamente, false si no se borró
     */
    public static function borrarUsuario($oUsuario)
    {
        $sql = "DELETE FROM T01_Usuario WHERE T01_CodUsuario = :usuario";

        try {
            $consulta = DBPDO::ejecutarConsulta($sql, [
                ':usuario' => $oUsuario->getCodUsuario()
            ]);

            // rowCount() para ver si se borro la fila
            if ($consulta->rowCount() > 0) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
        return false;
    }
}
