<!DOCTYPE html>
<html lang="en">
<?php
include 'ConexionSeq.php';
session_start(); // Comunicación entre Log In de PHP

// En caso de que guste Entrar

if (!isset($_SESSION['Usuario']) || empty($_SESSION['Usuario'])) {
    echo '
    <script type="text/javascript">
        alert("Debes iniciar sesión");
        window.location ="../Log-InP.php";
    </script>
    ';
    session_destroy();
    die();
} else {
    // Conexión a la base de datos
    $enlace = new mysqli("localhost:3307", "root", "", "idiomas");

    if ($enlace->connect_error) {
        die("Conexión fallida: " . $enlace->connect_error);
    }

    $usuario = $_SESSION['Usuario'];

    // Consulta para obtener el tipo de usuario
    $stmt = $enlace->prepare("SELECT TipoUsuario FROM registroidiomas WHERE Usuario=?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tipoUsuario = $row['TipoUsuario'];

        if ($tipoUsuario != 'profesor') {
            echo '
            <script>
                alert("No tienes permisos de profesor.");
                window.location = "../Log-InP.php";
            </script>
            ';
            session_destroy();
            die();
        }
    } else {
        echo '
        <script>
            alert("Usuario no encontrado en la base de datos.");
            window.location = .."/Log-InP.php";
        </script>
        ';
        session_destroy();
        die();
    }
}


?>

<head>
    <meta charset="utf-8">
    <title>Poly Glob</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Php" name="keywords">
    <meta content="Php" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!--favicon-->
    <link href="img/favicon_io/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style> .h-16 {
    height: 4rem;
   }</style>

<!--favico-->
    <link href="../img/favicon_io/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light d-none d-lg-block">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small><i class="fa fa-phone-alt mr-2"></i>+52 443 612 3498</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>PolyGlob@gmail.com</small>
                </div>
            </div>
            </div>
            <div class="col-lg-6 text-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-primary px-2" href="https://www.facebook.com/CLEMoreliaOficial">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-primary px-2" href="https://twitter.com/PolyGlob">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-primary px-2" href="https://instagram.com/PolyGlob">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-primary pl-2" href="https://youtube.com/PolyGlobChannel">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="#" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-primary"><span class="text-dark">Poly</span> Glob</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="indexM.php" class="nav-item nav-link">Inicio</a> 
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Opciones</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <!--falta el apartado de modificaciones-->
                            <a href="#" class="dropdown-item" onclick="mostrarAlerta()">Modificación</a>
                            <a href="PROF/Califalumnos.php" class="dropdown-item">Calificaciones</a>
                            <a href="Cerrar_Sesion.php" class="dropdown-item">Cerrar Sesión</a>
                            <!--faltaria la pagina de calificaciones-->
                        </div>
                    </div>
                    <a href="#" class="nav-item nav-link active">Contacto</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
    <!--  End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid bg-jumbotron" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">Contacto</h3>
            <div class="d-inline-flex align-items-center text-white">
                <i class="far fa-circle px-3"></i>
                <p class="m-0">Contacto</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

 
    <!-- Contact Start -->
    <?php
// Iniciar sesión y conectar a la base de datos

// Configuración de la conexión a la base de datos

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "idiomas";

// Crear la conexión
$enlace = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($enlace->connect_error) {
    die("Conexión fallida: " . $enlace->connect_error);
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["maestro"])) {
    $nombre = mysqli_real_escape_string($enlace, $_POST['Nombre']);
    $email = mysqli_real_escape_string($enlace, $_POST['CorreoE']);
    $Leng = mysqli_real_escape_string($enlace, $_POST['Lenguaje']);
    $Exp = mysqli_real_escape_string($enlace, $_POST['Exp']);

    // Mensaje de depuración para verificar los datos recibidos
    echo "Nombre: $nombre, Email: $email, Lenguaje: $Leng, Experiencia: $Exp<br>";

    // Insertar los datos en la base de datos
    $insertarDatos = "INSERT INTO solicitudmaestro (ID_Solicitud, Nombre, CorreoE, Lenguaje, Experiencia) 
                      VALUES (NULL, '$nombre', '$email', '$Leng', '$Exp')";

    if (mysqli_query($enlace, $insertarDatos)) {
        echo '<script type="text/javascript">
                alert("Solicitud enviada con éxito.");
                window.location = "../contact.php";
              </script>';
        exit();
    } else {
        echo '<script type="text/javascript">
                alert("Error: ' . mysqli_error($enlace) . '");
              </script>';
    }
    mysqli_close($enlace);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Maestro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container-fluid py-5">
    <img class="position-absolute w-100 h-100" src="img/Carousel-3.jpg" style="object-fit: cover;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <iframe class="position-absolute w-100 h-100" src="" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div class="col-lg-6 pt-5 pb-lg-5">
                <div class="contact-form bg-light p-4 p-lg-5 my-lg-5">
                    <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Contacto</h6>
                    <h1 class="mb-4">Contáctanos para formar parte de nuestro Equipo</h1>
                    <form action="Maestro.php" method="post" name="maestro" id="contactForm" novalidate="novalidate">
                        <div class="form-row">
                            <div class="col-sm-6 control-group">
                                <input type="text" class="form-control border-0 p-4" minlength="15" id="name" name="Nombre" placeholder="Nombre Sol." required="required" data-validation-required-message="Nombre Solicitante" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-sm-6 control-group">
                                <input type="email" class="form-control border-0 p-4" id="email" name="CorreoE" placeholder="Correo Electrónico" required="required" data-validation-required-message="Por favor llena tu email" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <input type="text" minlength="3" class="form-control border-0 p-4" id="subject" name="Lenguaje" placeholder="Lenguaje a enseñar" required="required" data-validation-required-message="Lenguaje " />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control border-0 py-3 px-4" minlength="100" rows="3" id="message" name="Exp" placeholder="Experiencia" required="required" data-validation-required-message="Escribe tu experiencia"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-3 px-4" type="submit" name="maestro">Enviar Solicitud</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

    <!-- Contact End -->

    <div class="rounded-md bg-white py-12 px-8 lg:px-9 lg:pt-16 lg:pb-20">
        <h2 class="text-center text-2xl font-semibold uppercase">Idiomas</h2>
        <p class="mt-3 mb-5 text-center text-base sm:text-lg md:mb-7 lg:mb-8 xl:mb-10">Idiomas más demandados</p>
        <div class="flex w-full flex-wrap justify-center space-y-5 md:gap-10 md:space-y-0 xl:gap-20">
            <div class="w-80 sm:w-4/5 md:w-72 flex flex-col items-center gap-y-2">
            <img src="img/Flag_of_the_US.webp" alt="Inglés" class="h-16">
            <strong class="py-1 sm:py-0">Inglés</strong>
                <p class="text-justify">Explore the world of English with us! English is a widely spoken language that can open many doors for you. Our courses are designed for all levels, ensuring you have a personalized learning experience. Our engaging lessons focus on improving grammar, vocabulary, and speaking skills. With our modern facilities and technology, learning English is easy and enjoyable. Whether you want to advance your career, travel, or just learn something new, mastering English will broaden your horizons. Join our community today and let English be your key to a world of communication, culture, and connections. Unlock your language potential with us!</p>
            </div>
            <div class="w-80 sm:w-4/5 md:w-72 flex flex-col items-center gap-y-2">
            <img src="img/Flag_of_France.png" alt="Francés" class="h-16">
            <strong class="py-1 sm:py-0">Francés</strong>
            <p class="text-justify">Explorez la richesse du français avec notre plateforme linguistique ! Le français, langue élégante et mondiale, ouvre les portes à une multitude d'opportunités. Nos cours, dirigés par des experts, s'adaptent à tous les niveaux, assurant une expérience d'apprentissage personnalisée. Plongez dans des leçons captivantes, améliorant grammaire, vocabulaire et compétences conversationnelles. 
             Rejoignez notre communauté dès aujourd'hui et laissez le français être votre clé vers un monde de communication, de culture et de connexions. Libérez votre potentiel linguistique avec nous !</p></div>
            <div class="w-80 sm:w-4/5 md:w-72 flex flex-col items-center gap-y-2">
            <img src="img/Flag_of_Germany.png" alt="Alemán" class="h-16">
            <strong class="py-1 sm:py-0">Alemán</strong><p class="text-justify">Entdecken Sie die Vielfalt der deutschen Sprache auf unserer Plattform! Deutsch, eine prächtige und weltweit gesprochene Sprache, öffnet Türen zu zahlreichen Möglichkeiten. Unsere von Experten geleiteten Kurse sind auf alle Niveaus zugeschnitten und bieten eine individuelle Lernerfahrung. Tauchen Sie ein in spannende Lektionen, um Grammatik, Wortschatz und Konversation zu verbessern. Unsere modernen Einrichtungen und technologiebasierten Ansätze machen das Deutschlernen einfach und unterhaltsam. Egal, ob Sie beruflich vorankommen, reisen oder einfach etwas Neues lernen möchten – die Beherrschung der deutschen Sprache erweitert Ihren Horizont. Treten Sie noch heute unserer Gemeinschaft bei und lassen Sie Deutsch Ihr Schlüssel zu einer Welt der Kommunikation, Kultur und Verbindungen sein. Entfesseln Sie Ihr sprachliches Potenzial mit uns!</p></div></div></div>

    <!-- Footer Start -->
    <div class="footer container-fluid position-relative bg-dark py-5" style="margin-top: 90px;">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 pr-lg-5 mb-5">
                    <a href="index.php" class="navbar-brand">
                        <h1 class="mb-3 text-white"><span class="text-primary">Poly</span>Glob</h1>
                    </a>
                    <p>Con nostros aprenderas por que aprenderas si o que no lo crees !.</p>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>Av Tecnologico, Morelia, MX</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+52 443 612 3498</p>
                    <p><i class="fa fa-envelope mr-2"></i>PolyGlob@gmail.com</p>
                    <div class="d-flex justify-content-start mt-4"></div>
                    </div>
                </div>
                <div class="col-lg-6 pl-lg-5">
                    <div class="row">
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Enlaces Rápidos</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Nuestros servicios</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Francés</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Alemán</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Inglés</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Ruso</a>
                                <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2">Italiano</i></a>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Novedades</h5>
                            <div class="w-100">
                                <div class="input-group">
                                    <div class="input-group-append">
                                      <p>Nuevo Sistema de selección SQL</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top py-4" style="border-color: rgba(256, 256, 256, .15) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0 text-white">&copy; <a href="#">Poly GLob</a>. Todos los derechos Reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0 text-white">Designed by Ken, Jose and René</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
     
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <script>
        function mostrarAlerta() {
            alert("Hablar con tu administrador para modificar tus datos");
        }
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    
</body>
</html>