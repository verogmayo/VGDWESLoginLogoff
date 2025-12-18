<?php
/**
* @author: Véro Grué
* @since: 18/12/2025
*/

 require_once 'DBPDO.php';
 require_once 'Usuario.php';


class UsuarioPDO {

    public static function validarUsuario(string $codUsuario, string $password): ?Usuario {

        $sql = <<<SQL
            SELECT
                T01_CodUsuario,
                T01_Password,
                T01_DescUsuario,
                T01_FechaHoraUltimaConexion,
                T01_NumConexiones,
                T01_Perfil,
                T01_ImagenUsuario
            FROM T01_Usuarios
            WHERE T01_CodUsuario = :usuario
              AND T01_Password = SHA2(:password,256)
        SQL;

        $consulta = DBPDO::ejecutarConsulta($sql, [
            ':usuario'  => $codUsuario,
            ':password' => $codUsuario . $password   // igual que en tu código original
        ]);

        $usuarioDB = $consulta->fetch(PDO::FETCH_ASSOC);

        if (!$usuarioDB) {
            return null;
        }

        $oUsuario = new Usuario(
            $usuarioDB['T01_CodUsuario'],
            $usuarioDB['T01_Password'],
            $usuarioDB['T01_DescUsuario'],
            $usuarioDB['T01_NumConexiones'],
            new DateTime($usuarioDB['T01_FechaHoraUltimaConexion']),
            $usuarioDB['T01_Perfil'],
            $usuarioDB['T01_ImagenUsuario']
        );

        self::actualizarUltimaConexion($oUsuario);

        return $oUsuario;
    }

    private static function actualizarUltimaConexion(Usuario $usuario): void {

        $sql = <<<SQL
            UPDATE T01_Usuarios SET
                T01_FechaHoraUltimaConexion = NOW(),
                T01_NumConexiones = T01_NumConexiones + 1
            WHERE T01_CodUsuario = :usuario
        SQL;

        DBPDO::ejecutarConsulta($sql, [
            ':usuario' => $usuario->getCodUsuario()
        ]);
    }
}
    
?>