<?php
class UsuarioController {
    private $usuarioModel;
    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }
    public function listar_usuarios () {
        return $this->usuarioModel->get_usuarios();
    }
    public function actualizar_usuario($datos){
        $flash = [
            "estado"=>2,
            "mensaje"=>"Datos no actualizados."
        ];
        if ($this->usuarioModel->update_usuario($datos) == 1) {
            $flash = [
                "estado"=>1,
                "mensaje"=>"Datos actualizados correctamente."
            ];
        }
        return $flash;
    }
    public function agregar_usuario($datos){
        $flash = [
            "estado" => 2,
            "mensaje" => "Datos no actualizados."
        ];
        if ( $this->usuarioModel->create_usuario($datos) == 1) {
            $flash = [
                "estado" => 1,
                "mensaje" => "Datos creados correctamente"
            ];
        }
        return $flash;

    }
}