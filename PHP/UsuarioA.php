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
        $stmt = $enlace->prepare("SELECT * FROM registroidiomas WHERE Usuario=? AND Contraseña=?");
        $stmt->bind_param("ss", $usuario, $contrasena);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['Usuario'] = $usuario;
            header("location:PRINCIPAL/index.php");
            exit(); // Asegúrate de detener el script aquí
        } else {
            echo '<script>
                alert("Usuario no existe, por favor verifica");
                window.location = "Log-In.php";
            </script>';
            exit(); // Asegúrate de detener el script aquí también
        }
    } else {
        echo 'Usuario o contraseña no están definidos. Por favor, intente de nuevo.';
        header("location:Log-In.php");
        exit();
    }
} else {
    echo 'El formulario no ha sido enviado correctamente.';
    header("location: Log-In.php");
    exit();
}
//atoradisimo
die();

$validar_login = mysqli_query($enlace, "SELECT * FROM registroidiomas WHERE Usuario='$usuario'
and Contraseña='$contrasena'");


if(mysqli_num_rows($validar_login) > 0){
  echo'<script type="text/javascript">
        alert ("Ingreso");
        windows.location:/PRINCIPAL/index.php";
    </script>';
  $_SESSION['Usuario'] = $usuario;
     //faltaria poner la pagina Principal
  exit();
}else{
echo '
    <script>
       alert ("Usuario no existe, por favor verifique los datos");
        window.location ="Log-In.php";
    </script>
      ';
      exit();
}
// punto doble y barra para que regrese a esa ubicacion

?>
