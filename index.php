<?php
// Incluir la clase de base de datos y CRUD
include_once 'config/Database.php';
include_once 'classes/CRUD.php';

// Crear la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear un objeto de la clase CRUD y pasarle la conexión
$crud = new CRUD($db);

// Obtener todos los vehículos de la base de datos
$vehiculos = $crud->getAllVehiculos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos</title>
    <!-- Agregar Bootstrap para diseño -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Listado de Vehículos</h2>
    <a href="crear.php" class="btn btn-primary mb-3">Agregar Nuevo Vehículo</a>
    
    <!-- Tabla de Vehículos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Placa</th>
                <th>Problema</th>
                <th>Fecha de Ingreso</th>
                <th>Fecha de Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Recorrer todos los vehículos y generar las filas de la tabla
            foreach ($vehiculos as $vehiculo) {
                echo "<tr>";
                echo "<td>" . $vehiculo['marca'] . "</td>";
                echo "<td>" . $vehiculo['modelo'] . "</td>";
                echo "<td>" . $vehiculo['placa'] . "</td>";
                echo "<td>" . $vehiculo['problema'] . "</td>";
                echo "<td>" . $vehiculo['fecha_ingreso'] . "</td>";
                echo "<td>" . $vehiculo['fecha_salida'] . "</td>";
                echo "<td>";
                // Botón de editar
                echo "<a href='editar.php?id=" . $vehiculo['id'] . "' class='btn btn-warning btn-sm'>Editar</a> ";
                // Botón de eliminar
                echo "<a href='eliminar.php?id=" . $vehiculo['id'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Agregar el script de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php 
        // Limpiar el mensaje después de mostrarlo
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    ?>
<?php endif; ?>

</html>

