<?php
session_start();
$enlace = new mysqli("localhost:3307", "root", "", "idiomas");

if ($enlace->connect_error) {
    die("Error de conexión: " . $enlace->connect_error);
}

function esAdministrador($enlace, $usuario) {
    $stmt = $enlace->prepare("SELECT TipoUsuario FROM registroidiomas WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuarioDatos = $result->fetch_assoc();
    return $usuarioDatos && $usuarioDatos['TipoUsuario'] === 'administrador';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn_registrar_curso"])) {
    if (!empty($_POST["clave_curso"]) && !empty($_POST["nombre_maestro"]) && !empty($_POST["idioma"]) &&
        !empty($_POST["nivel_general"]) && !empty($_POST["clasificacion"]) &&
        !empty($_POST["fecha_inicio"]) && !empty($_POST["cupo"])) {

        $clave_curso = htmlspecialchars($_POST["clave_curso"]);
        $nombre_maestro = htmlspecialchars($_POST["nombre_maestro"]);
        $idioma = htmlspecialchars($_POST["idioma"]);
        $nivel_general = htmlspecialchars($_POST["nivel_general"]);
        $clasificacion = htmlspecialchars($_POST["clasificacion"]);
        $fecha_inicio = htmlspecialchars($_POST["fecha_inicio"]);
        $cupo = (int)$_POST["cupo"];

        if (esAdministrador($enlace, $_SESSION['Usuario'])) {
            $stmt = $enlace->prepare("SELECT COUNT(*) AS Total FROM curso WHERE ClaveCurso = ?");
            $stmt->bind_param("i", $clave_curso);
            $stmt->execute();
            $result = $stmt->get_result();


            if ($result->fetch_object()->Total > 0) {
                echo "<p style='color: red;'>La clave del curso ya está registrada.</p>";
            } else {
                $stmt = $enlace->prepare("INSERT INTO curso (ClaveCurso, NombredeMaestro, Idioma, NivelGeneral, Clasificacion, FechaInicio, Cupo) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssssi", $clave_curso, $nombre_maestro, $idioma, $nivel_general, $clasificacion, $fecha_inicio, $cupo);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Curso registrado correctamente.</p>";
                } else {
                    echo "<p style='color: red;'>Error al registrar el curso. Inténtalo de nuevo.</p>";
                }
            }

            $stmt->close();
        } else {
            echo "<p style='color: red;'>Solo los administradores pueden registrar cursos.</p>";
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
    <title>Registro de Curso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h4 class="text-center text-secondary">Registro de Curso</h4>
        <form action="" method="POST">
            <!-- Campo Clave del Curso -->
            <div class="form-group">
                <label for="clave_curso">Clave del Curso</label>
                <input type="text" id="clave_curso" name="clave_curso" class="form-control" placeholder="Clave del Curso" required>
            </div>
            <!-- Campo Nombre del Maestro -->
            <div class="form-group">
                <label for="nombre_maestro">Nombre del Maestro</label>
                <input type="text" id="nombre_maestro" name="nombre_maestro" class="form-control" placeholder="Nombre del Maestro" required>
            </div>
            <!-- Campo Idioma -->
            <div class="form-group">
                <label for="idioma">Idioma</label>
                <input type="text" id="idioma" name="idioma" class="form-control" placeholder="Idioma" required>
            </div>
            <!-- Campo Nivel General -->
            <div class="form-group">
                <label for="nivel_general">Nivel General</label>
                <input type="text" id="nivel_general" name="nivel_general" class="form-control" placeholder="Nivel General" required>
            </div>
            <!-- Campo Clasificación -->
            <div class="form-group">
                <label for="clasificacion">Clasificación</label>
                <input type="text" id="clasificacion" name="clasificacion" class="form-control" placeholder="Clasificación" required>
            </div>
            <!-- Campo Fecha de Inicio -->
            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
            </div>
            <!-- Campo Cupo -->
            <div class="form-group">
                <label for="cupo">Cupo</label>
                <input type="number" id="cupo" name="cupo" class="form-control" placeholder="Cupo" required>
            </div>
            <!-- Botones -->
            <div class="text-right">
                <a href="javascript:history.back()" class="btn btn-secondary">Atrás</a>
                <button type="submit" name="btn_registrar_curso" class="btn btn-primary">Registrar Curso</button>
            </div>
        </form>
    </div>
</body>
</html>
