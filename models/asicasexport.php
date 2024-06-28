<?php

class AsiCasExport
{
    private $con;
    public function __construct(){
        $this->con = new pdo_conexion;
    }
    public function select_all(){
        $qry = $this->con->prepare('SELECT a.fecha,a.hora,a.dia_sem,u.ape_pat,u.ape_mat,u.nom_usu,u.cor_inst,a.descripcion FROM asi_cas_export a inner join usuarios_asicas u on a.id_admin=u.id_usu order by fecha,hora desc');
        $qry->execute();
        return $qry->fetchAll();
    }
    public function insert($admin,$fecha,$hora,$dia_sem,$des){
        $qry = $this->con->prepare('INSERT INTO asi_cas_export (id_admin,fecha,hora,dia_sem,descripcion) VALUES(:id_admin,:fecha,:hora,:dia_sem,:descripcion)');
        $qry->bindParam(":id_admin",$admin);
        $qry->bindParam(":fecha",$fecha);
        $qry->bindParam(":hora",$hora);
        $qry->bindParam(":dia_sem",$dia_sem);
        $qry->bindParam(":descripcion",$des);
        if ( $qry->execute() ) {
            return 1;
        }
        return 2;
    }
}
