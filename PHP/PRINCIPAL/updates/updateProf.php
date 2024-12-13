<?php
class UpdateProf {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function updateRecord($noControl, $nombre, $apellidos, $contraseña, $correo, $sueldo, $fechaIn, $telefono) {
        $sql = "UPDATE profesor SET Nombre=?, Apellidos=?, Contraseña=?, Correo=?, Sueldo=?, FechaIn=?, Telefono=? WHERE NoControl=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("isssssdi", $noControl, $nombre, $apellidos, $contraseña, $correo, $sueldo, $fechaIn, $telefono);
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

$updateInstance = new UpdateProf($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['NoControl'])) {
    $noControl = $_POST['NoControl'];
    $nombre = $_POST['Nombre'];
    $apellidos =$_POST['Apellidos'];
    $contraseña =$_POST['Contraseña'];
    $correo =$_POST['Correo'];
    $sueldo =$_POST['Sueldo'];
    $fechaIn =$_POST['FechaIn']; 
    $telefono =$_POST['Telefono']; 

        $updateInstance->updateRecord($noControl, $nombre, $apellidos, $contraseña, $correo, $sueldo, $fechaIn, $telefono);

    header("Location: ../testimonialMaes.php");
    exit();

    $updateInstance->closeConnection();
}
?>
