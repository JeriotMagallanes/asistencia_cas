<?php
require_once ('./google7/vendor/autoload.php');

$authUrl ="procesos/login_google.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h3><i>Asistencia de Personal CAS</i></h3><br>
                        <h6>Iniciar Sesión</h6>
                        <br><br>
                        <br>
                        <div class="form-group mb-5 mt-5">
                            <a href="<?php echo $authUrl;?>" class="btn btn-danger"><i class="fa-brands fa-google"></i> Correo Institucional</a>
                        </div>
                        <br><br>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white pt-3 pb-3 text-center w-100" style="position:fixed;bottom:0px;">
        &copy; Copyright 2022. Desarrollado por la Oficina de Tecnología de la Información
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>
</html>