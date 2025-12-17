<?php 
class Usuario{
    private $CodUsuario;
    private $Password;
    public $DescUsuario;
    public $NumConexiones;
    public $FechaUltimaConexion;
    public $Perfil;
    public $ImagenUsuario;


    public function __construct($CodUsuario = '', $Password = '', $DescUsuario = '', $NumConexiones = , $FechaUltimaConexion = '', $Perfil = '', $ImagenUsuario = '') {
        $this->CodUsuario = $CodUsuario;
        $this->Password = $Password;
        $this->DescUsuario = $DescUsuario;
        $this->NumConexiones = $NumConexiones;
        $this->FechaUltimaConexion = $FechaUltimaConexion;
        $this->Perfil = $Perfil;
        $this->ImagenUsuario = $ImagenUsuario;
    }

}
?>