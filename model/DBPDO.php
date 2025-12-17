<?php
class DBPDO {
   private $host = 'localhost';
    private $db = 'tu_base_de_datos';
    private $user = 'tu_usuario';
    private $pass = 'tu_contraseña';
    private $charset = 'utf8mb4';
    private $miDB;

    private function __construct() {
        try {
        $miDB = new PDO("mysql:host=$this->host;dbname=$this->db;charset=$this->charset");
        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function getPDO() {
        return $this->miDB;
    }
}
?>