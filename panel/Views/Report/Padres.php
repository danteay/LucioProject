<?php

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Padres;

$instance = new Padres();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte Padres</title>

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
        <div class="large-12 columns">
            <h2>Reporte Padres</h2>
        </div>
        <div class="large-12 columns">
            <hr>
        </div>
    </div>

    <?php if(isset($_GET['error'])){ ?>
        <section class="row">
            <div class="large-12 columns">
                <a href="#" class="atomist-alert">
                    <?php echo $_GET['error']; ?>
                </a>
            </div>
        </section>
    <?php } ?>

    <div class="row">
        <div class="large-12 columns">
            <table>
                <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Detalles</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $allrows = $instance->getAllItems();
                while ($fila = $allrows->fetch_object()){
                    ?>

                    <tr>
                        <td style="text-align: center;">
                            <a href="../../Controllers/Edit/PadresController.php?id=<?php echo $fila->idPadre; ?>">
                                <img src="../../img/delete.png" alt="Editar" style="width: 20px; height: auto;">
                            </a>
                        </td>
                        <td><?php echo $fila->idPadre; ?></td>
                        <td><?php echo $fila->nombre." ".$fila->paterno." ".$fila->materno; ?></td>
                        <td><?php echo $fila->correo; ?></td>
                        <td>
                            <a href="../Details/Padres.php?id=<?php echo $fila->idPadre; ?>">
                                <img src="../../img/details.png" alt="Detalles" style="width: 20px; height: auto;">
                            </a>
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