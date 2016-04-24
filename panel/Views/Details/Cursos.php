<?php
require_once __DIR__."/../../vendor/autoload.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

use CorePHP\Models\Cursos;
use CorePHP\Models\DocumentosCurso;
use CorePHP\Models\JuegosCurso;
use CorePHP\Models\VideosCurso;

$instance = new Cursos();
$docs = new DocumentosCurso($instance->conx);
$games = new JuegosCurso($instance->conx);
$videos = new VideosCurso($instance->conx);

$id = $_GET['id'];
$flag = $instance->getItem($id);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Curso</title>

    <link rel="stylesheet" href="../../css/foundation.min.css">
    <link rel="stylesheet" href="../../css/app.css">
    <link rel="stylesheet" href="../../js/AtomistAlerts/atomist-alert.css">
</head>
<body>

<nav>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="menu-text">Panel de administración</li>
                <li><a href="../">Inicio</a></li>
                <li>
                    <a href="#">Administradores</a>
                    <ul class="menu vertical">
                        <li><a href="../Report/Administradores.php">Ver Registrados</a></li>
                        <li><a href="../Add/Administradores.php">Agregar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Padres</a>
                    <ul class="menu vertical">
                        <li><a href="../Report/Padres.php">Ver Registrados</a></li>
                        <li><a href="../Add/Padres.php">Agregar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Cursos</a>
                    <ul class="menu vertical">
                        <li><a href="../Report/Cursos.php">Ver Registrados</a></li>
                        <li><a href="../Add/Cursos.php">Agregar</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="top-bar-right">
            <ul class="menu">
                <li><a class="button" href="../../Controllers/LoginController.php?logout">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<main>
    
    <?php if ($flag){ ?>

        <header class="row">
            <div class="large-10 columns">
                <h2><?php echo $instance->titulo; ?></h2>
            </div>
            <div class="large-2 columns">
                <a href="../../Views/Report/Cursos.php" class="expanded button">Regresar</a>
            </div>
            <div class="large-12 columns">
                <hr>
            </div>
        </header>

        <section>
            <div class="row">
                <div class="large-12 columns">
                    <h4>Descripción</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <?php echo $instance->descripcion; ?>
                </div>
            </div>
            <br><br>
        </section>

        <section>
            <div class="row">
                <div class="large-12 columns">
                    <h4>Temario</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div id="temario" class="large-12 columns">
                    <?php
                    $parser = new Parsedown();
                    echo $parser->text($instance->temario);
                    ?>
                </div>
            </div>
        </section>

    <?php }else{ ?>
        <section class="row">
            <div class="large-12 columns">
                <a id="erroredit" href="#" class="atomist-alert">
                    No se encontro el elemento
                </a>
            </div>
        </section>
    <?php } ?>
    
</main>

<script src="../../js/vendor/jquery.js"></script>
<script src="../../js/vendor/foundation.min.js"></script>
<script src="../../js/app.js"></script>
<script src="../../js/AtomistAlerts/atomist-alert.js"></script>
<script src="../../js/bower_components/showdown/dist/showdown.min.js"></script>

</body>
</html>