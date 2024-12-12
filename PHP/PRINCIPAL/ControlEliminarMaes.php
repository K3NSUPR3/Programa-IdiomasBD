<?php
require_once 'ConexionSeq.php';

if (!empty($_GET["id"])) {
    $id = intval($_GET["id"]); // Convierte a entero para mayor seguridad

    // Verifica que la conexión a la base de datos esté establecida
    if ($enlace->connect_error) {
        die("Conexión fallida: " . $enlace->connect_error);
    }

    // Prepara y ejecuta la consulta para eliminar de la tabla `inscripciones`
    $stmt = $enlace->prepare("DELETE FROM inscripciones WHERE Id_Insc = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>
            $(function notification() {
                new PNotify({
                    title: "Correcto",
                    type: "success",
                    text: "Inscripción eliminada correctamente",
                    styling: "bootstrap3"
                });
            });
        </script>';
    } else {
        echo '<script>
            $(function notification() {
                new PNotify({
                    title: "Incorrecto",
                    type: "error",
                    text: "No se pudo eliminar la inscripción",
                    styling: "bootstrap3"
                });
            });
        </script>';
    }

    $stmt->close();
} else {
    //echo '<script>alert("No se recibió un ID válido para eliminar.");</script>';
}

$enlace->close();
?>
