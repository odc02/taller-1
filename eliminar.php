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

    // Llamar al método para eliminar el vehículo
    if ($crud->eliminarVehiculo($id)) {
        echo "Vehículo eliminado exitosamente";
        header("Location: index.php"); // Redirigir al listado
        exit();
    } else {
        echo "Error al eliminar el vehículo.";
    }
} else {
    echo "No se ha proporcionado el id del vehículo.";
}
?>

