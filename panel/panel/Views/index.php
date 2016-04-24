<?php
require_once __DIR__."/../vendor/autoload.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="../css/foundation.min.css">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>

<nav>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="menu-text">Panel de administración</li>
                <li><a href="#">Inicio</a></li>
                <li>
                    <a href="#">Administradores</a>
                    <ul class="menu vertical">
                        <li><a href="Report/Administradores.php">Ver Registrados</a></li>
                        <li><a href="Add/Administradores.php">Agredar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Padres</a>
                    <ul class="menu vertical">
                        <li><a href="Report/Padres.php">Ver Registrados</a></li>
                        <li><a href="Add/Padres.php">Agredar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Cursos</a>
                    <ul class="menu vertical">
                        <li><a href="Report/Cursos.php">Ver Registrados</a></li>
                        <li><a href="Add/Cursos.php">Agredar</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="top-bar-right">
            <ul class="menu">
                <li><a class="button" href="../Controllers/LoginController.php?logout">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="row">
        <div class="large-12 columns">
            <h1>Secciones</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="large-12 columns">
            <ul class="menu vertical">
                <li><a href="Report/Cursos.php" class="expanded button">Cursos</a></li>
                <li><a href="Report/Padres.php" class="expanded button">Padres</a></li>
            </ul>
        </div>
    </div>
</main>

<script src="../js/vendor/jquery.js"></script>
<script src="../js/vendor/foundation.min.js"></script>
<script src="../js/app.js"></script>

</body>
</html>