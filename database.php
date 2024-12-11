<?php
class Database {
    private $host = "localhost"; // Cambia esto si es necesario
    private $db_name = "crud"; // Nombre de tu base de datos
    private $username = "root"; // Usuario de la base de datos (por defecto en XAMPP)
    private $password = ""; // Contraseña (vacía por defecto en XAMPP)
    private $conn;

    // Obtener la conexión a la base de datos
    public function getConnection() {
        $this->conn = null;
        
        try {
            // Se usa PDO para conectarse a la base de datos
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establecer modo de error
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn; // Retorna la conexión
    }
}
?>
