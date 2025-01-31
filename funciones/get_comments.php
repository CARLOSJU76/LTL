<?php
// archivo: get_comments.php
header('Content-Type: text/html; charset=utf-8');

header('Content-Type: application/json');

// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_rank";
$port = 3307;

        // $host = "localhost";
        // $baseDatos="ltlwqtsb_sistema_rank" ;
        // $usuario= "ltlwqtsb_carlosju76" ;
        // $clave= "Sistema_rank*2024";

try {
    // Crear conexión con PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
    
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta para obtener los comentarios
    $sql = "SELECT id, comentario, autor, fecha_hora, likes FROM comentarios ORDER BY fecha_hora DESC";
    
    // Ejecutar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Obtener todos los resultados
    $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // En caso de error, se captura la excepción
    echo json_encode(['error' => 'Conexión fallida: ' . $e->getMessage()]);
    exit;
}

// Devolver los datos en formato JSON
echo json_encode($comentarios);

// Cerrar la conexión (no es estrictamente necesario con PDO, ya que se cierra automáticamente cuando se destruye el objeto)
$conn = null;
?>
