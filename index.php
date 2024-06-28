<?php
session_start();
date_default_timezone_set('America/Lima');
$fec_hoy = date("Y-m-d");
$s = (isset($_GET["busqueda"])) ? $_GET["busqueda"] : "";
include './conexion/pdo_conexion.php';
include "./helper/local_undc.php";
include "./helper/formato_fecha.php";
include "./helper/estados.php";
$estado = new Estado;
include "./helper/roles.php";
$roles = new Roles; 
// $local = new Local();
// $formato_fecha = new FormatoFecha();

if(isset($_SESSION["auth"]) && $_SESSION["auth"] == 1 ){
    include "./view/template/index.php";
}else{
    include "./view/login.php";
}?>
<script>
    $(document).ready(function(){
    <?php 
		if ( isset($_SESSION["flash"]) ){
			switch ($_SESSION["flash"]["estado"]) {
				case 1: ?>
					Swal.fire({
						icon: 'success',
						title: 'Exito !',
						text: '<?php echo $_SESSION["flash"]["mensaje"];?>',
						//footer: '<a href="">Why do I have this issue?</a>'
					})
					<?php
					break;
				case 2: ?>
					Swal.fire({
						icon: 'info',
						title: 'Error!',
						text: '<?php echo $_SESSION["flash"]["mensaje"];?>',
						//footer: '<a target="_blank" href="https://wa.me/51959913931">Soporte Informatico</a>'
					})
					<?php 
					break;
				case 3: ?>
					Swal.fire({
						icon: 'warning',
						title: 'Ups !',
						text: '<?php echo $_SESSION["flash"]["mensaje"];?>',
						footer: '<a target="_blank" href="https://wa.me/51959913931">Soporte Informatico</a>'
					})
					<?php 
					break;
				default:
					# code...
					break;
			}
		}
		unset($_SESSION["flash"]);
	?>
	})
</script>