<?php
require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Padres;
use CorePHP\Models\Infantes;

$objpadre = new Padres();
$objhijo = new Infantes($objpadre->conx);

$id = $_GET['id'];
$flag = $objpadre->getItem($id);
$infantes = $objhijo->getAllItemsByTutor($id);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Padre</title>

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
        <div class="row">
            <div class="large-10 columns">
                <h2>Detalles del Padre</h2>
            </div>
            <div class="large-2 columns">
                <a href="../../Views/Report/Padres.php" class="expanded button">Regresar</a>
            </div>
            <div class="large-12 columns">
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <blockquote>
                    <?php echo "<b>Nombre:</b> ".$objpadre->nombre." ".$objpadre->paterno." ".$objpadre->materno."<br>"; ?>
                    <?php echo "<b>Correo:</b> ".$objpadre->correo."<br>"; ?>
                    <?php echo "<b>Password:</b> ".$objpadre->passwd."<br>"; ?>
                </blockquote>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <h3>Infantes tutorados: <?php echo $infantes->num_rows; ?></h3>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Paterno</th>
                        <th>Materno</th>
                        <th>Code</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($fila = $infantes->fetch_object()){
                    ?>
                        <tr>
                            <td><?php echo $fila->idInfante; ?></td>
                            <td><?php echo $fila->nombre; ?></td>
                            <td><?php echo $fila->paterno; ?></td>
                            <td><?php echo $fila->materno; ?></td>
                            <td><?php echo $fila->hashcode; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
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

</body>
</html>
