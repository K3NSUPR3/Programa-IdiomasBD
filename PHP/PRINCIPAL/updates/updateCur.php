<?php
class UpdateCur {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function updateRecord($ClaveCurso, $NombredeMaestro, $Idioma, $NivelGeneral, $Clasificacion, $FechaInicio, $CupoTipo) {
        $sql = "UPDATE curso SET NombredeMaestro=?, Idioma=?, NivelGeneral=?, Clasificacion=?, FechaInicio=?, Cupo=? WHERE ClaveCurso=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("ssssssi", $NombredeMaestro, $Idioma, $NivelGeneral, $Clasificacion, $FechaInicio, $CupoTipo, $ClaveCurso);
        if ($stmt->execute() === TRUE) {
            echo "Registro actualizado exitosamente.";
        } else {
            echo "Error actualizando" . $stmt->error;
        }

        $stmt->close();
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// Configuración de la base de datos
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "idiomas";

// Crear una instancia de la clase UpdateCur
$updateInstance = new UpdateCur($servername, $username, $password, $dbname);

// Verificar si la solicitud es POST y la clave del curso está establecida
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ClaveCurso'])) {
    $ClaveCurso = $_POST['ClaveCurso'];
    $NombredeMaestro = $_POST['NombredeMaestro'];
    $Idioma = $_POST['Idioma'];
    $NivelGeneral = $_POST['NivelGeneral'];
    $Clasificacion = $_POST['Clasificacion'];
    $FechaInicio = $_POST['FechaInicio'];
    $CupoTipo = $_POST['Cupo'];

    // Actualizar el registro
    $updateInstance->updateRecord($ClaveCurso, $NombredeMaestro, $Idioma, $NivelGeneral, $Clasificacion, $FechaInicio, $CupoTipo);

    // Redireccionar a la página testimonial.php después de actualizar
    header("Location: ../testimonialCur.php");
    exit();
}

// Cerrar la conexión a la base de datos
$updateInstance->closeConnection();
?>
