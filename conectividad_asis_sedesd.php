<?php

$host="localhost";
$user="root";
$pass="";
$datab="cas";

$connection = mysqli_connect($host, $user, $pass);
$db = mysqli_select_db($connection, $datab);

$locations = [
    1 => "CASA DE LA CULTURA",
    2 => "CNI",
    4 => "LUNAHUNA",
    5 => "SAN AGUSTIN",
    6 => "HUALCARÁ",
];

$tiempo_tolerancia = 2;

function fetchLocationData($connection, $local_undc)
{
    global $tiempo_tolerancia;
    $consulta = "SELECT * FROM cron_asi_cas WHERE local_undc = $local_undc ORDER BY id_cron DESC LIMIT 1";
    $result = mysqli_query($connection, $consulta);
    $data = mysqli_fetch_array($result);

    $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
    $nows = $timestamp->format('H:i:s');
    $datex7 = new DateTime($nows);
    $datex77 = new DateTime($data['hora']);
    $horax7 = date_diff($datex7, $datex77);
    $hx7x7 = $horax7->format('%i');
    //$hx7x7= 3; // para hacer pruebas 
    return [
        'location' => $local_undc,
        'name' => $locations[$local_undc],
        'fecha' => $data['fecha'],
        'hora' => $data['hora'],
        'ip_public' => $data['ip_public'],
       
        'connection_status' => $hx7x7 >= $tiempo_tolerancia ? 'Sin conexión' : 'Ok',
        'internet_speed' => $hx7x7 >= $tiempo_tolerancia ? 'Sin conexión' : $data['test_internet'],
    ];
}

// Comprobar si la solicitud es una solicitud AJAX
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Manejar la solicitud AJAX para recuperar datos
    $local_undc = $_GET['local_undc'];
    $data = fetchLocationData($connection, $local_undc);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Conectividad de asistencias de sedes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand text-white" href="#">Conectividad</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                    <th scope="col">IP pública</th>
                    <th scope="col">Conexión</th>
                    <th scope="col">Velocidad de Internet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($locations as $local_undc => $locationName) {
                    $locationData = fetchLocationData($connection, $local_undc);
                    ?>
                <tr id="locationRow<?= $locationData['location']; ?>">
                    <th scope="row"><?= $locationData['location']; ?></th>
                    <td><?= $locationData['name']; ?></td>
                    <td class="fecha"><?= $locationData['fecha']; ?></td>
                    <td class="hora"><?= $locationData['hora']; ?></td>
                    <td class="ip_public"><?= $locationData['ip_public']; ?></td>
                    <td><span
                            class="badge <?= $locationData['connection_status'] == 'Sin conexión' ? 'text-bg-warning' : 'text-bg-success'; ?> connection_status"><?= $locationData['connection_status']; ?></span>
                    </td>
                    <td class="internet_speed"><?= $locationData['internet_speed']; ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function updateTableData() {
        <?php foreach ($locations as $local_undc => $locationName) { ?>
        $.ajax({
            url: '<?= $_SERVER['PHP_SELF']; ?>?local_undc=<?= $local_undc; ?>',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var row = $('#locationRow<?= $local_undc; ?>');
                row.find('.fecha').text(data.fecha);
                row.find('.hora').text(data.hora);
                row.find('.ip_public').text(data.ip_public);
                row.find('.connection_status').text(data.connection_status);
                row.find('.internet_speed').text(data.internet_speed);
            },
            error: function() {
                // Manejar cualquier error
            }
        });
        <?php } ?>
    }
    // Llame a la función inicialmente
    updateTableData();
    // Actualiza los datos de la tabla cada 5 segundos (ajusta el intervalo según sea necesario)
    setInterval(updateTableData, 5000); // 5000 milisegundos = 5 segundos
    </script>
</body>

</html>