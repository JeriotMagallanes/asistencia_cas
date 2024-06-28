<?php
define("API_KEY","");

 
$headers = getallheaders();
$apiKey = $headers['Authorization'] ?? '';
if($apiKey !== API_KEY ){

    header("Location: http://asistencia_cas.test");
    exit; 
}else{
    header('Content-Type: application/json');
    include_once "conexion/pdo_conexion.php";
    $pdo = new pdo_conexion;
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $stmt = $pdo->query("SELECT * FROM personal_administrativo_nuevo WHERE sincronizado=0");
            $cas = $stmt->fetchAll();
            echo json_encode($cas);
            break;
    
        case 'POST':
                $confirms = json_decode(file_get_contents('php://input'), true);
                if (empty($confirms)) {
                    echo json_encode(['error' => 'No se proporcionaron datos.']);
                    break;
                }
            

                $stmt = $pdo->prepare("UPDATE personal_administrativo_nuevo SET `sincronizado`='1' WHERE  `dni_pa`=?;");
            
                try {
                    $pdo->beginTransaction();
                    foreach ($confirms as $doc) {
                        if (!is_numeric($doc)) {
                            throw new Exception("Dato inválido.");
                        }
                        $stmt->execute([$doc]);
                    }
                    $pdo->commit();
                    echo json_encode(['success' => 'Todos los registros fueron actualizados exitosamente.']);
                } catch (Exception $e) {
                    $pdo->rollBack();
                    echo json_encode(['error' => "Error al actualizar registros: " . $e->getMessage()]);
                } finally {
                    $stmt->closeCursor();
                }
                break;
    
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
    
}?>