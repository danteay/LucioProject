<?php
require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Administradores;

$instance = new Administradores();
$id = $_GET['id'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administradores</title>

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
                        <li><a href="../Add/Administradores.php">Agredar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Padres</a>
                    <ul class="menu vertical">
                        <li><a href="../Report/Padres.php">Ver Registrados</a></li>
                        <li><a href="../Add/Padres.php">Agredar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Cursos</a>
                    <ul class="menu vertical">
                        <li><a href="../Report/Cursos.php">Ver Registrados</a></li>
                        <li><a href="../Add/Cursos.php">Agredar</a></li>
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

    <header class="row">
        <div class="large-12 columns">
            <h2>Editar Administrador</h2>
            <hr>
        </div>
    </header>

    <?php if($instance->getItem($id)){ ?>
        <?php if(isset($_GET['error'])){ ?>
            <section class="row">
                <div class="large-12 columns">
                    <a href="#" class="atomist-alert">
                        <?php echo $_GET['error']; ?>
                    </a>
                </div>
            </section>
        <?php } ?>

        <section class="row">
            <div class="large-12 columns">
                <div class="top-bar">
                    <div class="top-bar-right">
                        <ul class="menu">
                            <li><a class="button alert" href="../Report/Administradores.php">Cancelar</a></li>
                            <li><a id="sentform" class="button success" href="#">Guardar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="large-12 columns">
                <div class="callout">
                    <form id="editform" action="../../Controllers/Edit/AdministradoresController.php" method="post">
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="">Correo
                                    <p><?php echo $instance->correo; ?></p>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                label{Contraseña}>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }else{ ?>

    <?php } ?>

</main>

<script src="../../js/vendor/jquery.js"></script>
<script src="../../js/vendor/foundation.min.js"></script>
<script src="../../js/app.js"></script>
<script src="../../js/AtomistAlerts/atomist-alert.js"></script>

</body>
</html>