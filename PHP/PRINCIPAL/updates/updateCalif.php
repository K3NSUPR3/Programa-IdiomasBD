<?php
class UpdateCalif{
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function updateRecord($U1, $U2, $U3, $U4, $U5,$Prom,$IdCalifica) {
        $sql = "UPDATE calificacionesa SET U1=?, U2=?, U3=?, U4=?, U5=?, Promedio=? WHERE IdCalifica=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("isssssd", $IdCalifica, $U1, $U2, $U3, $U4, $U5, $Prom);
        if ($stmt->execute() === TRUE) {
            echo "Registro actualizado ";
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

$updateInstance = new UpdateCalif($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['IdCalifica'])) {
    $IdCalifica=$_['IdCalifica'];
    $U1 = $_POST['U1'];
    $U2=  $_POST['U2'];
    $U3 = $_POST['U3'];
    $U4 = $_POST['U4'];
    $U5 = $_POST['U5'];
    $Prom=$_POST['Promedio'];
    //$promedio = ($U1 + $U2 + $U3 + $U4 + $U5) / 5;

    $updateInstance->updateRecord($U1,$U2,$U3,$U4,$U5,$Prom,$IdCalifica);

    header("location:../PROF/Califalumnos.php");
    exit();
}

$updateInstance->closeConnection();
?>
