<?php
session_start();
$enlace = new mysqli("localhost:3307", "root", "", "idiomas");

if ($enlace->connect_error) {
    die("Error de conexión: " . $enlace->connect_error);
}
  //verififcar que no esta entrando otro usuarios que no sea administrador
function esAdministrador($enlace, $usuario) {
    $stmt = $enlace->prepare("SELECT TipoUsuario FROM registroidiomas WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuarioDatos = $result->fetch_assoc();
    $stmt->close();
    return $usuarioDatos && $usuarioDatos['TipoUsuario'] === 'administrador';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn_registrar"])) {
    if (!empty($_POST["numero_control"]) && !empty($_POST["nombre"]) && !empty($_POST["apellidos"]) && 
        !empty($_POST["contrasena"]) && !empty($_POST["correo"]) && 
        !empty($_POST["sueldo"]) && !empty($_POST["fecha_ingreso"]) && !empty($_POST["telefono"])) {

        $numero_control = htmlspecialchars($_POST["numero_control"]);
        $nombre = htmlspecialchars($_POST["nombre"]);
        $apellidos = htmlspecialchars($_POST["apellidos"]);
        $contrasena = htmlspecialchars($_POST["contrasena"]);
        //encriptacion de la contraseña
        $contrasenae="";
        $contrasenae=hash('sha512', $contrasena);
        $correo = htmlspecialchars($_POST["correo"]);
        $sueldo = htmlspecialchars($_POST["sueldo"]);
        $fecha_ingreso = htmlspecialchars($_POST["fecha_ingreso"]);
        $telefono = htmlspecialchars($_POST["telefono"]);

        if (esAdministrador($enlace, $_SESSION['Usuario'])) {
            $stmt = $enlace->prepare("SELECT COUNT(*) AS Total FROM profesor WHERE NoControl = ?");
            $stmt->bind_param("i", $numero_control);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->fetch_object()->Total > 0) {
                echo "<p style='color: red;'>El número de control ya está registrado.</p>";
            } else {
                $stmt = $enlace->prepare("INSERT INTO profesor (NoControl, Nombre, Apellidos, Contraseña, Correo, Sueldo, FechaIn, Telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                //tipo de dato i para int s para string y d para double
                $stmt->bind_param("issssdss", $numero_control, $nombre, $apellidos, $contrasenae, $correo, $sueldo, $fecha_ingreso, $telefono);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Profesor registrado correctamente.</p>";
                } else {
                    echo "<p style='color: red;'>Error al registrar al profesor. Inténtalo de nuevo.</p>";
                }
            }

            $stmt->close();
        } else {
            echo "<p style='color: red;'>Solo los administradores pueden registrar profesores.</p>";
        }
    } else {
        echo "<p style='color: red;'>Por favor, completa todos los campos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Profesor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
</head>
<body>
    <div class="container mt-5">
        <h4 class="text-center text-secondary">Registro de Profesor</h4>
        <form action="" method="POST">
            <!-- Campo Número de Control -->
            <div class="form-group">
                <label for="control">Número de Control</label>
                <input type="text" id="control" name="numero_control" class="form-control" placeholder="Número de Control" required>
            </div>
            <!-- Campo Nombre -->
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <!-- Campo Apellidos -->
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Apellidos" required>
            </div>
            <!-- Campo Contraseña -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="contrasena" class="form-control" minlenght="8" placeholder="Contraseña" required>
            </div>
            <!-- Campo Correo Electrónico -->
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="correo" class="form-control" placeholder="Correo Electrónico" required>
            </div>
            <!-- Campo Sueldo -->
            <div class="form-group">
                <label for="sueldo">Sueldo</label>
                <input type="number" step="0.01" id="sueldo" name="sueldo" class="form-control" placeholder="Sueldo" required>
            </div>
            <!-- Campo Fecha de Ingreso -->
            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" class="form-control" required>
            </div>
            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono" required>
            </div>
            <!-- Botones -->
            <div class="text-right">
                <a href="javascript:history.back()" class="btn btn-secondary">Atrás</a>
                <button type="submit" name="btn_registrar" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>
</body>
</html>
