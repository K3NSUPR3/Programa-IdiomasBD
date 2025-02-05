<?php
require_once '../ConexionSeq.php'; 

if (!empty($_GET["id"])) {
    $id = intval($_GET["id"]); // Convierte a entero para mayor seguridad
    echo "ID recibido: " . $id; // Verifica que la conexión a la base de datos esté establecida if ($enlace->connect_error) { die("Conexión fallida: " .

    $stmt = $enlace->prepare("DELETE FROM curso WHERE  ClaveCurso= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    

    if ($stmt->affected_rows > 0) {
        echo '<script>
            $(function notification() {
                new PNotify({
                    title: "Correcto",
                    type: "success",
                    text: "Asistencia Eliminada Correctamente",
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
                    text: "Error al eliminar",
                    styling: "bootstrap3"
                });
            });
        </script>';
    }

    $stmt->close();
} else {
    echo '<script></script>';
}
?>
