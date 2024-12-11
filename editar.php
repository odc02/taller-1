<?php
// Incluir la clase de base de datos y CRUD
include_once 'config/Database.php';
include_once 'classes/CRUD.php';

// Crear la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear un objeto de la clase CRUD y pasarle la conexión
$crud = new CRUD($db);

// Verificar si existe el parámetro 'id' en la URL
if (isset($_GET['id'])) {
    // Obtener el id del vehículo desde la URL
    $id = $_GET['id'];

    // Obtener los datos del vehículo para editarlo
    $query = "SELECT id, marca, modelo, placa, problema, fecha_ingreso, fecha_salida FROM registro_vehiculos WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Si el vehículo existe, obtener sus datos
    $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra el vehículo, redirigir al índice
    if (!$vehiculo) {
        header("Location: index.php");
        exit();
    }

    // Si se recibe el formulario de edición
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recibir los datos del formulario
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $placa = $_POST['placa'];
        $problema = $_POST['problema'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $fecha_salida = $_POST['fecha_salida'];

        // Llamar al método para editar el vehículo
        if ($crud->editarVehiculo($id, $marca, $modelo, $placa, $problema, $fecha_ingreso, $fecha_salida)) {
            echo "Vehículo actualizado exitosamente";
            header("Location: index.php"); // Redirigir al listado
            exit();
        } else {
            echo "Error al actualizar el vehículo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Vehículo</h2>
    <form action="editar.php?id=<?php echo $vehiculo['id']; ?>" method="POST">
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control" value="<?php echo $vehiculo['marca']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo $vehiculo['modelo']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" name="placa" id="placa" class="form-control" value="<?php echo $vehiculo['placa']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="problema" class="form-label">Problema</label>
            <textarea name="problema" id="problema" class="form-control" required><?php echo $vehiculo['problema']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="<?php echo $vehiculo['fecha_ingreso']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="fecha_salida" class="form-label">Fecha de Salida</label>
            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" value="<?php echo $vehiculo['fecha_salida']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

