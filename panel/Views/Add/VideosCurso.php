<?php
require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Cursos;

$curso = new Cursos();
$id = $_GET['curso'];

$flag = $curso->getItem($id);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Video de Curso</title>

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
    <header class="row">
        <div class="large-12 columns">
            <h2>Nuevo video de Curso</h2>
            <hr>
        </div>
    </header>

    <?php if($flag){ ?>
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
                            <li><a href="../Details/Cursos.php?id=<?php echo $id; ?>" class="button">Cancelar</a></li>
                            <li><a id="sentform" href="#" class="button success">Guardar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="large-12 columns">
                <div class="callout">
                    <form id="addform" action="../../Controllers/Add/VideosCursoController.php" method="post">
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="">Titulo<input type="text" name="titulo" id="titulo"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="">Frame<input type="text" name="frame" id="frame"></label>
                            </div>
                        </div>

                        <input type="hidden" name="curso" value="<?php echo $id; ?>">
                    </form>
                </div>
            </div>
        </div>
    <?php }else{ ?>
        <section class="row">
            <div class="large-12 columns">
                <a id="errorelem" href="#" class="atomist-alert">
                    El elemento no ha sido identificado.
                </a>
            </div>
        </section>
    <?php } ?>

</main>

<script src="../../js/vendor/jquery.js"></script>
<script src="../../js/vendor/foundation.min.js"></script>
<script src="../../js/vendor/what-input.js"></script>
<script src="../../js/app.js"></script>
<script src="../../js/AtomistAlerts/atomist-alert.js"></script>
<script src="../../js/bower_components/showdown/dist/showdown.min.js"></script>

<script>
    $(document).ready(function(){
        $("#sentform").click(function(evt){
            evt.preventDefault();
            document.querySelector("#addform").submit();
        });

        $("#errorelem").click(function(){
            window.location.href = "../Report/Cursos.php";
        });
    });

    var alerts = new AtomistAlerts();
    alerts.init();
</script>

</body>
</html>