<?php
class Update {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function updateRecord($nombre, $correo, $fecha, $idioma, $Plan, $id_Insc) {
        $sql = "UPDATE inscripciones SET Nombre=?, Correo=?, Fecha=?, Horario=?, Idioma=? WHERE Id_Insc=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("Requisitos", $nombre, $correo, $fecha, $idioma, $id_Insc, $Plan);
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Id_Insc'])) {
    $nombre = $_POST['Nombre'];
    $correo = $_POST['Correo'];
    $fecha = $_POST['Fecha'];
    $idioma = $_POST['Idioma'];
    $Plan = $_POST['Plan'];
    $id_Insc = $_POST['ID_Insc'];

    $updateInstance->updateRecord($nombre, $correo, $fecha, $idioma, $Plan, $id_Insc);

    header("Location:../testimonial.php");
    exit();
}

$updateInstance->closeConnection();
?>
