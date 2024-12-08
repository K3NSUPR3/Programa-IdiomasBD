<?php
include 'Conexion_Be.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Usuario']) && isset($_POST['password1'])) {
        $usuario = $_POST['Usuario'];
        $contrasena = $_POST['password1'];

        // Conexión a la base de datos
        $enlace = new mysqli("localhost:3307", "root", "", "idiomas");

        if ($enlace->connect_error) {
            die("Conexión fallida: " . $enlace->connect_error);
        }

        // Asegúrate de usar sentencias preparadas para evitar inyecciones SQL
        $stmt = $enlace->prepare("SELECT TipoUsuario FROM registroidiomas WHERE Usuario=? AND Contraseña=?");
        $stmt->bind_param("ss", $usuario, $contrasena);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $rowQ = $result->fetch_assoc();
            $tipoUsuario = $rowQ['TipoUsuario'];

            if ($tipoUsuario == 'administrador') {
                $_SESSION['Usuario'] = $usuario;
                echo '<script type="text/javascript">
                        alert("Ingreso");
                        window.location = "PRINCIPAL/testimonial.php";
                      </script>';
                exit();
            } else {
                echo '<script>
                        alert("No tienes permisos de administrador.");
                        window.location = "Log-InU.php";
                      </script>';
                exit();
            }
        } else {
            echo '<script>
                    alert("Usuario o contraseña incorrectos, por favor verifica");
                    window.location = "Log-InU.php";
                  </script>';
            exit();
        }
    } else {
        echo 'Usuario o contraseña no están definidos. Por favor, intente de nuevo.';
        header("location: Log-InU.php");
        exit();
    }
} else {
    echo 'El formulario no ha sido enviado correctamente.';
    header("location: Log-InU.php");
    exit();
}
?>