<?php
class Update {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function updateRecord($nombre, $apellido, $email, $contrasena, $id, $usuario) {
        $sql = "UPDATE registroidiomas SET Nombre=?, Apellido=?, Email=?, Contraseña=?, Usuario=? WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("sssssi", $nombre, $apellido, $email, $contrasena, $usuario, $id);
        if ($stmt->execute() === TRUE) {
            echo "Registro actualizado exitosamente.";
        } else {
            echo "Error actualizando el registro: " . $this->conn->error;
        }

        $stmt->close();
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "idiomas";

$updateInstance = new Update($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ID'])) {
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['Email'];
    $contrasena = $_POST['Contraseña'];
    $id = $_POST['ID'];
    $usuario = $_POST['Usuario'];

    $updateInstance->updateRecord($nombre, $apellido, $email, $contrasena, $id, $usuario);

    header("location:../testimonial.php");
    exit();
}

$updateInstance->closeConnection();
?>
