<?php
// Incrementa el número de likes para un comentario dado

// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_rank";
$port= 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos JSON enviados en la solicitud
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$liker=$data['name'];
$currentDate= $data['currentDate'];
//Vefificando si el usuario ya ha dado like hoy: 
$checkLikeQuery = "SELECT COUNT(*) FROM dando_like WHERE id_comentario = ? AND liker = ? AND fecha = ?";
$checkStmt = $conn->prepare($checkLikeQuery);
$checkStmt->bind_param("iss", $id, $liker, $currentDate);
$checkStmt->execute();
$checkStmt->bind_result($likeCount);
$checkStmt->fetch();
$checkStmt->close();

if ($likeCount > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Ya has dado like a este comentario hoy.']);
    $conn->close();
    exit();
}else{
    //Registrando los likes en la tabla dando_like: 
$consulta = "INSERT INTO dando_like (id_comentario, liker) VALUES (?, ?)";
$sqliker = $conn->prepare($consulta);
$sqliker->bind_param("is", $id, $liker);  // "i" para entero y "s" para string
$sqliker->execute();
// Incrementar el número de likes

$sql = "UPDATE comentarios SET likes = likes + 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

// Verificar si la actualización fue exitosa
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

}


// Cerrar la conexión
$stmt->close();
$conn->close();
?>
