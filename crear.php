<?php
// Incluir la clase de base de datos y CRUD
include_once 'config/Database.php';
include_once 'classes/CRUD.php';

// Crear la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear un objeto de la clase CRUD y pasarle la conexión
$crud = new CRUD($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $problema = $_POST['problema'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_salida = $_POST['fecha_salida'];

    // Llamar al método para agregar el vehículo
    if ($crud->agregarVehiculo($marca, $modelo, $placa, $problema, $fecha_ingreso, $fecha_salida)) {
        echo "Vehículo agregado exitosamente";
        header("Location: index.php"); // Redirigir al listado
        exit();
    } else {
        echo "Error al agregar el vehículo.";
    }

    if ($crud->agregarVehiculo($marca, $modelo, $placa, $problema, $fecha_ingreso, $fecha_salida)) {
        $_SESSION['message'] = 'Registro agregado exitosamente';
        $_SESSION['message_type'] = 'success'; // El tipo de alerta es 'success'
        header("Location: index.php"); // Redirigir a la página principal
        exit();
    } else {
        $_SESSION['message'] = 'Hubo un error al agregar el registro';
        $_SESSION['message_type'] = 'danger'; // El tipo de alerta es 'danger' para error
        header("Location: index.php"); // Redirigir a la página principal
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Agregar Nuevo Vehículo</h2>
    <form action="crear.php" method="POST">
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" name="placa" id="placa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="problema" class="form-label">Problema</label>
            <textarea name="problema" id="problema" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fecha_salida" class="form-label">Fecha de Salida</label>
            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

