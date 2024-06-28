<?php
$host="localhost";
$user="root";
$pass="";
$datab="cas";

$connection = mysqli_connect($host, $user, $pass);
$db = mysqli_select_db($connection, $datab);

// $consulta = "SELECT * FROM cron_asi_cas WHERE local_undc = 5 AND WHERE local_undc = 4 ORDER BY id_cron DESC LIMIT 1";
// $result = mysqli_query($connection,$consulta);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Conectividad de asistencias de sedes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-success">
    <a class="navbar-brand text-white" href="#">Conectividad</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#"></a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">

    <h3 class="text-center">Conectividad de asistencias e internet de sedes -UNDC </h3>
    <table class="table">
      <thead class="bg-success">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Sede</th>
          <th scope="col">Fecha</th>
          <th scope="col">Ultima Hora</th>
          <th scope="col">IP publica</th>
          <th scope="col">Conexión</th>
          <th scope="col">Velocidad de Internet</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $consulta1 = "SELECT * FROM cron_asi_cas WHERE local_undc = 1  ORDER BY id_cron DESC LIMIT 1";
        $result1 = mysqli_query($connection, $consulta1);
        //TIEMPO DE TOLERANCIA PARA  SABER SI HAY CONEXION 
        $tiempo_tolerancia = 2;

        while ($colum = mysqli_fetch_array($result1)) {
        ?>
          <tr>
            <th scope="row"><?php echo $colum['local_undc'];    ?></th>
            <td> <?php echo "CASA DE LA CULTURA"; ?></td>
            <td><?php echo $colum['fecha']; ?></td>
            <td><?php echo $colum['hora']; ?></td>
            <td><?php echo $colum['ip_public']; ?></td>
            <td><?php
                $pas_date = $colum['hora'];
                $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
                $nows = $timestamp->format('H:i:s');
                $datex7 = new DateTime($nows);
                $datex77 = new DateTime($pas_date);
                $horax7 = date_diff($datex7, $datex77);
                $hx7x7 = $horax7->format('%i');
                if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo "<span class='badge text-bg-success'>Ok</span>";
                }
                ?></td>
            <td><?php if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo $colum['test_internet'];
                } ?></td>



          </tr>
        <?php
        }
        $consulta2 = "SELECT * FROM cron_asi_cas WHERE local_undc = 2  ORDER BY id_cron DESC LIMIT 1";
        $result2 = mysqli_query($connection, $consulta2);

        while ($colum = mysqli_fetch_array($result2)) {
        ?>
          <tr>
            <th scope="row"><?php echo $colum['local_undc']; ?></th>
            <td> <?php echo "CNI"; ?></td>
            <td><?php echo $colum['fecha']; ?></td>
            <td><?php echo $colum['hora']; ?></td>
            <td><?php echo $colum['ip_public']; ?></td>
            <td><?php
                $pas_date = $colum['hora'];
                $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
                $nows = $timestamp->format('H:i:s');
                $datex7 = new DateTime($nows);
                $datex77 = new DateTime($pas_date);
                $horax7 = date_diff($datex7, $datex77);
                $hx7x7 = $horax7->format('%i');
                if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo "<span class='badge text-bg-success'>Ok</span>";
                }
                ?></td>
            <td><?php if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo $colum['test_internet'];
                } ?></td>
          </tr>

        <?php
        }
        $consulta4 = "SELECT * FROM cron_asi_cas WHERE local_undc = 4 ORDER BY id_cron DESC LIMIT 1";
        $result4 = mysqli_query($connection, $consulta4);

        while ($colum = mysqli_fetch_array($result4)) {
        ?>
          <tr>
            <th scope="row"><?php echo $colum['local_undc']; ?></th>
            <td> <?php echo "LUNAHUNA"; ?></td>
            <td><?php echo $colum['fecha']; ?></td>
            <td><?php echo $colum['hora']; ?></td>
            <td><?php echo $colum['ip_public']; ?></td>
            <td><?php
                $pas_date = $colum['hora'];
                $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
                $nows = $timestamp->format('H:i:s');
                $datex7 = new DateTime($nows);
                $datex77 = new DateTime($pas_date);
                $horax7 = date_diff($datex7, $datex77);
                $hx7x7 = $horax7->format('%i');
                if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo "<span class='badge text-bg-success'>Ok</span>";
                }
                ?></td>
            <td><?php if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo $colum['test_internet'];
                } ?></td>
          </tr>
        <?php
        }
        $consulta5 = "SELECT * FROM cron_asi_cas WHERE local_undc = 5  ORDER BY id_cron DESC LIMIT 1";
        $result5 = mysqli_query($connection, $consulta5);

        while ($colum = mysqli_fetch_array($result5)) {
        ?>
          <tr>
            <th scope="row"><?php echo $colum['local_undc']; ?></th>
            <td> <?php echo "SAN AGUSTIN"; ?></td>
            <td><?php echo $colum['fecha']; ?></td>
            <td><?php echo $colum['hora']; ?></td>
            <td><?php echo $colum['ip_public']; ?></td>
            <td><?php
                $pas_date = $colum['hora'];
                $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
                $nows = $timestamp->format('H:i:s');
                $datex7 = new DateTime($nows);
                $datex77 = new DateTime($pas_date);
                $horax7 = date_diff($datex7, $datex77);
                $hx7x7 = $horax7->format('%i');

                if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo "<span class='badge text-bg-success'>Ok</span>";
                }
                ?></td>
            <td><?php if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo $colum['test_internet'];
                } ?></td>
          </tr>
        <?php } ?>

        <?php

        $consulta3 = "SELECT * FROM cron_asi_cas WHERE local_undc = 6 ORDER BY id_cron DESC LIMIT 1";
        $result3 = mysqli_query($connection, $consulta3);

        while ($colum = mysqli_fetch_array($result3)) {
        ?>
          <tr>
            <th scope="row"><?php echo $colum['local_undc'];  ?></th>
            <td> <?php echo "HUALCARÁ"; ?></td>
            <td><?php echo $colum['fecha']; ?></td>
            <td><?php echo $colum['hora']; ?></td>
            <td><?php echo $colum['ip_public']; ?></td>
            <td><?php
                $pas_date = $colum['hora'];
                $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
                $nows = $timestamp->format('H:i:s');
                $datex7 = new DateTime($nows);
                $datex77 = new DateTime($pas_date);
                $horax7 = date_diff($datex7, $datex77);
                $hx7x7 = $horax7->format('%i');

                if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo "<span class='badge text-bg-success'>Ok</span>";
                }
                ?></td>
            <td><?php if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo $colum['test_internet'];
                } ?></td>
          </tr>
        <?php  } ?>

        <?php

        $consulta3 = "SELECT * FROM cron_asi_cas WHERE local_undc = 7 ORDER BY id_cron DESC LIMIT 1";
        $result3 = mysqli_query($connection, $consulta3);

        while ($colum = mysqli_fetch_array($result3)) {
        ?>
          <tr>
            <th scope="row"><?php echo $colum['local_undc'];  ?></th>
            <td> <?php echo "SAN LUIS"; ?></td>
            <td><?php echo $colum['fecha']; ?></td>
            <td><?php echo $colum['hora']; ?></td>
            <td><?php echo $colum['ip_public']; ?></td>
            <td><?php
                $pas_date = $colum['hora'];
                $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
                $nows = $timestamp->format('H:i:s');
                $datex7 = new DateTime($nows);
                $datex77 = new DateTime($pas_date);
                $horax7 = date_diff($datex7, $datex77);
                $hx7x7 = $horax7->format('%i');

                if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo "<span class='badge text-bg-success'>Ok</span>";
                }
                ?></td>
            <td><?php if ($hx7x7 >= $tiempo_tolerancia) {
                  echo "<span class='badge text-bg-warning'>Sin conexión</span>";
                } else {
                  echo $colum['test_internet'];
                } ?></td>
          </tr>
        <?php  } ?>

      </tbody>
    </table>

  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
</body>

</html>