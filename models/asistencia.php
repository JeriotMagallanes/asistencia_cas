<?php
class asistencia 
{
    private $con;
    public function __construct(){
        $this->con = new pdo_conexion;
    }
    public function select_marcacion_x_dia($fecha){
        $qry = $this->con->prepare("SELECT * FROM ");
    }
}
