<?php
class pdo_conexion extends PDO
{
	public function __construct(){
		$archivo='configuracion.ini';
        $ajustes=parse_ini_file($archivo,true);
        $servidor=$ajustes["database"]["hosting"];
        $puerto=$ajustes["database"]["protocolo"];
        $basededatos=$ajustes["database"]["schema"];
        try{
            parent::__construct("mysql:host=$servidor;port=$puerto;charset=UTF8;dbname=$basededatos",
                $ajustes["database"]["user"],
                $ajustes["database"]["pass"]);
            parent::setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,'SET NAMES utf8');
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $evento){
            echo "ERROR EN CONEXION: ".$evento->getMessage();
        }
    }
}

?>