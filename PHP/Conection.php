<?php
/*  En caso de ponerle contraseña
$servername = "localhost";
$database = "idiomas";
$username = "root";
$password = "CONTRASEÑA";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conn);

$errors = [];

// Si se ha enviado el formulario
if (isset($_POST ['login_button' ] )) {
$username = mysqli_real_escape_string($db, $_POST ['username' ] );
$password = mysqli_real_escape_string($db, $_POST['password' ] );

// Comprobar si el nombre de usuario es válido
$query = "SELECT * FROM users WHERE username='$username'";
$results = mysqli_query($db, $query);

if (mysqli_num_rows ($results) == 1) {
// Nombre de usuario válido, verificar contraseña
$row = mysqli_fetch_assoc($results);
if (password_verify($password, $row['password'])) {
// Inicio de sesión válido
$_SESSION ['username' ] = $username;
header ('location: home.phtml');
} else {
// Contraseña inválida
$errors [] = "Nombre de usuario/contrasena invalidos";

} else {
// Nombre de usuario inválido
$errors [] = "Nombre de usuario/contraseña invalidos";
  }
 }
}
 este codigo es un respaldo antiguo de el codigo para enlazar la BD*/
?>