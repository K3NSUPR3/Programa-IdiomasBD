<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> <!-- Asegúrate de enlazar tu archivo CSS -->
</head>
<body>
    <div class="page-content">
        <h4 class="text-center text-secondary">Registro de Usuario</h4>
        <div class="row">
            <form action="" method="POST">
                <!-- Campo Nombre -->
                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre">
                </div>
                <!-- Campo Apellido -->
                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido">
                </div>
                <!-- Campo Usuario -->
                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Usuario" class="input input__text" name="txtusuario">
                </div>
                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="email" minlength="8" placeholder="Correo" class="input input__text" name="txtcorreo">
                </div>
                <!-- Campo Contraseña -->
                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="password" placeholder="Contraseña" class="input input__text" name="txtcontrasena">
                </div>
                <!-- Campo Tipo Usuario -->
                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <select name="TipoUsuario" class="input input__text">
                        <option value="alumno">Alumno</option>
                        <option value="profesor">Profesor</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>
                <!-- Botones -->
                <div class="text-right p-2">
                    <a href="javascript:history.back()" class="btn btn-secondary btn-rounded">Atrás</a>
                    <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Añadir</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
session_start();
// Conexion a la base de datos (Asegúrate de ajustar los datos de conexión a tu configuración)
$enlace = new mysqli("localhost:3307", "root", "", "idiomas");

// Verificar conexión
if ($enlace->connect_error) {
    die("Error de conexión: " . $enlace->connect_error);
}

// Función para verificar si un usuario es administrador
function esAdministrador($enlace, $usuario) {
    $stmt = $enlace->prepare("SELECT TipoUsuario FROM registroidiomas WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuarioDatos = $result->fetch_assoc();
    $stmt->close();
    
    return $usuarioDatos && $usuarioDatos['TipoUsuario'] == 'administrador';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnregistrar"])) {
    // Verificar que todos los campos estén completos
    if (!empty($_POST["txtnombre"]) && !empty($_POST["txtapellido"]) && !empty($_POST["txtusuario"]) && !empty($_POST["txtcorreo"]) && !empty($_POST["txtcontrasena"]) && !empty($_POST["TipoUsuario"])) {
        $nombre = htmlspecialchars($_POST["txtnombre"]);
        $apellido = htmlspecialchars($_POST["txtapellido"]);
        $usuario = htmlspecialchars($_POST["txtusuario"]);
        $contrasena = htmlspecialchars($_POST["txtcontrasena"]);
        $correo = htmlspecialchars($_POST["txtcorreo"]);
        $tipoUsuario = htmlspecialchars($_POST["TipoUsuario"]);

        // Verificar si el usuario actual es administrador
        if (esAdministrador($enlace, $_SESSION['Usuario'])) {
            // Consulta para verificar si el nombre de usuario ya está en uso
            $stmt = $enlace->prepare("SELECT COUNT(*) AS Total FROM registroidiomas WHERE Usuario = ?");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->fetch_object()->Total > 0) {
                echo "<p style='color: red;'>El nombre de usuario ya está en uso. Por favor, elige otro.</p>";
            } else {
                // Insertar nuevo usuario
                $stmt = $enlace->prepare("INSERT INTO registroidiomas (Nombre, Apellido, Usuario,Email,Contraseña, TipoUsuario) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $nombre, $apellido, $usuario,$correo, $contrasena, $tipoUsuario);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Usuario registrado correctamente.</p>";
                } else {
                    echo "<p style='color: red;'>Error al registrar el usuario. Por favor, inténtalo de nuevo.</p>";
                }
            }

            $stmt->close(); // Cerrar la consulta
        } else {
            echo "<p style='color: red;'>Solo los administradores pueden registrar usuarios.</p>";
        }
    } else {
        echo "<p style='color: red;'>Por favor, completa todos los campos.</p>";
    }
}
?>