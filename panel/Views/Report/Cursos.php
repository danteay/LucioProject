<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Cursos;

$instance = new Cursos();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte Cursos</title>

    <link rel="stylesheet" href="../../css/foundation.min.css">
    <link rel="stylesheet" href="../../css/app.css">
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
    <div class="row">
        <div class="large-10 columns">
            <h2>Reporte Cursos</h2>
        </div>
        <div class="large-2 columns">
            <a class=" expanded button" href="../Add/Cursos.php">Nuevo</a>
        </div>
        <div class="large-12 columns">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="large-12 columns">
            <table>
                <thead>
                <tr>
                    <th>Editar</th>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $allrows = $instance->getAllItems();
                while ($fila = $allrows->fetch_object()){
                    ?>

                    <tr>
                        <td style="text-align: center;">
                            <a href="../Edit/Cursos.php?id=<?php echo $fila->idCurso; ?>">
                                <img src="../../img/edit.png" alt="Editar" style="width: 20px; height: auto;">
                            </a>
                        </td>
                        <td><?php echo $fila->idCurso; ?></td>
                        <td><?php echo $fila->titulo; ?></td>
                        <td>
                            <?php
                            echo (count_chars($fila->descripcion) > 70) ?
                                substr($fila->descripcion,0,70)."..." :
                                $fila->descripcion;
                            ?>
                        </td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="../../js/vendor/jquery.js"></script>
<script src="../../js/vendor/foundation.min.js"></script>
<script src="../../js/app.js"></script>

</body>
</html>