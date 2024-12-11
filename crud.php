<?php
class CRUD {
    private $conn;

    // Constructor recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para obtener todos los vehículos
    public function getAllVehiculos() {
        // Consulta para obtener todos los vehículos
        $query = "SELECT id, marca, modelo, placa, problema, fecha_ingreso, fecha_salida FROM registro_vehiculos";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        // Retornar todos los registros como un arreglo asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para agregar un vehículo
    public function agregarVehiculo($marca, $modelo, $placa, $problema, $fecha_ingreso, $fecha_salida) {
        $query = "INSERT INTO registro_vehiculos (marca, modelo, placa, problema, fecha_ingreso, fecha_salida)
                  VALUES (:marca, :modelo, :placa, :problema, :fecha_ingreso, :fecha_salida)";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Enlazar los parámetros
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':problema', $problema);
        $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
        $stmt->bindParam(':fecha_salida', $fecha_salida);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para editar un vehículo
    public function editarVehiculo($id, $marca, $modelo, $placa, $problema, $fecha_ingreso, $fecha_salida) {
        $query = "UPDATE registro_vehiculos SET marca = :marca, modelo = :modelo, placa = :placa, 
                  problema = :problema, fecha_ingreso = :fecha_ingreso, fecha_salida = :fecha_salida WHERE id = :id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Enlazar los parámetros
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':problema', $problema);
        $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
        $stmt->bindParam(':fecha_salida', $fecha_salida);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para eliminar un vehículo
    public function eliminarVehiculo($id) {
        $query = "DELETE FROM registro_vehiculos WHERE id = :id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Enlazar el parámetro
        $stmt->bindParam(':id', $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
