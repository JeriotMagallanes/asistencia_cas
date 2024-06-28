<?php
class UsuarioModel
{
    private $con;
    public function __construct(){
        $this->con = new pdo_conexion;
    }
    public function get_usuarios(){
        $qry = $this->con->prepare("SELECT * FROM usuarios_asicas where estado='A'");
        $qry->execute();
        return $qry->fetchAll();
    }
    public function update_usuario($datos){
        $qry = $this->con->prepare("UPDATE usuarios_asicas set ape_pat=:ape_pat,ape_mat=:ape_mat,nom_usu=:nom_usu,cor_per=:cor_per,cor_inst=:cor_inst,estado=:estado 
        WHERE id_usu=:id_usu");
        $qry->bindParam(":id_usu", $datos["id_usu"]);
        $qry->bindParam(":ape_pat", $datos["ape_pat"]);
        $qry->bindParam(":ape_mat", $datos["ape_mat"]);
        $qry->bindParam(":nom_usu", $datos["nom_usu"]);
        $qry->bindParam(":cor_per", $datos["cor_per"]);
        $qry->bindParam(":cor_inst", $datos["cor_inst"]);
        $qry->bindParam(":estado", $datos["estado"]);
        if ( $qry->execute() ) {
            return 1;
        }
        return 2;
    }
    public function create_usuario($datos){
        $qry = $this->con->prepare("INSERT INTO usuarios_asicas (ape_pat,ape_mat,nom_usu,cor_per,cor_inst,estado,rol) VALUES(UPPER(:ape_pat),UPPER(:ape_mat),UPPER(:nom_usu),:cor_per,:cor_inst,:estado,'A')");
        $qry->bindParam(":ape_pat",$datos["ape_pat"]);
        $qry->bindParam(":ape_mat",$datos["ape_mat"]);
        $qry->bindParam(":nom_usu",$datos["nom_usu"]);
        $qry->bindParam(":cor_per",$datos["cor_per"]);
        $qry->bindParam(":cor_inst",$datos["cor_inst"]);
        $qry->bindParam(":estado",$datos["estado"]);
        if ( $qry->execute() ) {
            return 1;
        }
        return 2;
        
    }
}
