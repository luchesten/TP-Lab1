<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Medallas Olímpicas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Registro de Medallas Olímpicas</h1>
        
        <!-- Formulario de ingreso -->
        <form action="insert.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="country">País:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="gold">Oro:</label>
                <input type="number" class="form-control" id="gold" name="gold" value="0" min="0">
            </div>
            <div class="form-group">
                <label for="silver">Plata:</label>
                <input type="number" class="form-control" id="silver" name="silver" value="0" min="0">
            </div>
            <div class="form-group">
                <label for="bronze">Bronce:</label>
                <input type="number" class="form-control" id="bronze" name="bronze" value="0" min="0">
            </div>
            <button type="submit" class="btn btn-primary">Registrar Medallas</button>
        </form>

        <!-- Mostrar medallas -->
        <h2 class="mt-5">Medallas Registradas</h2>
        <?php
        // Conectar a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'olympics');
        
        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        
        // Consultar medallas
        $sql = "SELECT * FROM medals";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo '<table class="table table-striped mt-3">';
            echo '<thead><tr><th>ID</th><th>País</th><th>Oro</th><th>Plata</th><th>Bronce</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['country']}</td><td>{$row['gold']}</td><td>{$row['silver']}</td><td>{$row['bronze']}</td></tr>";
            }
            echo '</tbody></table>';
        } else {
            echo "<p>No hay medallas registradas.</p>";
        }
        
        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
