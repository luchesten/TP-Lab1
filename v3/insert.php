<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'olympics');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$country = $_POST['country'];
$gold = $_POST['gold'];
$silver = $_POST['silver'];
$bronze = $_POST['bronze'];

// Insertar datos en la base de datos
$sql = "INSERT INTO medals (country, gold, silver, bronze) VALUES ('$country', $gold, $silver, $bronze)";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirigir de vuelta a la página principal
header('Location: index.php');
exit();
?>
