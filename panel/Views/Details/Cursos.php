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
            <br><br>
        </section>

        <section>
            <div class="row">
                <div class="large-12 columns">
                    <h4>Contenidos</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <ul class="tabs" data-tabs id="example-tabs">
                        <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Documentos</a></li>
                        <li class="tabs-title"><a href="#panel2">Videos</a></li>
                        <li class="tabs-title"><a href="#panel3">Juegos</a></li>
                    </ul>
                    <div class="tabs-content" data-tabs-content="example-tabs">

                        <div class="tabs-panel is-active" id="panel1">
                            <div class="row">
                                <div class="large-12 columns">
                                    <a class="expanded button" href="../Add/DocumentosCurso.php?curso=<?php echo $instance->idCurso; ?>">
                                        Agregar Documento
                                    </a>
                                </div>
                                <div class="large-12 columns">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Edit</th>
                                                <th>ID</th>
                                                <th>Titulo</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $alldocs = $docs->getAllItemsByCurso($id);
                                            while($doc = $alldocs->fetch_object()){
                                            ?>

                                                <tr>
                                                    <td style="text-align: center;">
                                                        <a href="../Edit/DocumentosCurso.php?id=<?php echo $doc->idDocumentoCurso; ?>">
                                                            <img src="../../img/edit.png" alt="Edit" style="width: 20px; height: auto;">
                                                        </a>
                                                    </td>
                                                    <td><?php echo $doc->idDocumentoCurso; ?></td>
                                                    <td><?php echo $doc->titulo; ?></td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="large-6 columns">
                                                                <a target="_blank" href="../../Repo/Documents/<?php echo $doc->documento; ?>">
                                                                    <img src="../../img/preview.png" alt="View" style="width: 20px; height: auto;">
                                                                </a>
                                                            </div>
                                                            <div class="large-6 columns">
                                                                <a href="../../Controllers/Edit/DocumentosCurso.php?id=<?php echo $doc->idDocumentoCurso; ?>">
                                                                    <img src="../../img/delete.png" alt="Delete" style="width: 20px; height: auto;">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tabs-panel" id="panel2">
                            <div class="row">
                                <div class="large-12 columns">
                                    <a class="expanded button" href="../Add/VideosCurso.php?curso=<?php echo $id; ?>">
                                        Agregar Video
                                    </a>
                                </div>
                                <div class="large-12 columns">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Edit</th>
                                            <th>ID</th>
                                            <th>Titulo</th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $allvideos = $videos->getAllItemsByCurso($id);
                                        while($video = $allvideos->fetch_object()){
                                            ?>

                                            <tr>
                                                <td style="text-align: center;">
                                                    <a href="../Edit/VideosCurso.php?id=<?php echo $video->idVideoCurso; ?>">
                                                        <img src="../../img/edit.png" alt="Edit" style="width: 20px; height: auto;">
                                                    </a>
                                                </td>
                                                <td><?php echo $video->idVideoCurso; ?></td>
                                                <td><?php echo $video->titulo; ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="large-6 columns">
                                                            <a onclick="previewVideo(<?php echo $video->idVideoCurso; ?>)">
                                                                <img src="../../img/preview.png" alt="View" style="width: 20px; height: auto;">
                                                            </a>
                                                        </div>
                                                        <div class="large-6 columns">
                                                            <a href="../../Controllers/Edit/VideosCurso.php?id=<?php echo $video->idVideoCurso; ?>">
                                                                <img src="../../img/delete.png" alt="Delete" style="width: 20px; height: auto;">
                                                            </a>
                                                        </div>

                                                        <input type="hidden" id="video_<?php echo $video->idVideoCurso; ?>" value="<?php echo $video->frame; ?>">
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tabs-panel" id="panel3">
                            <div class="row">
                                <div class="large-12 columns">
                                    <a href="../Add/JuegosCurso.php?curso=<?php echo $id ?>" class="expanded button">Agregar Juego</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="large-12 columns">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Edit</th>
                                                <th>ID</th>
                                                <th>Titulo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $allgames = $games->getAllItemsByCurso($id);
                                            while($game = $allgames->fetch_object()){
                                            ?>

                                                <tr>
                                                    <td style="text-align: center;">
                                                        <a href="../Edit/JuegosCurso.php?id=<?php echo $game->idJuegoCurso; ?>">
                                                            <img src="../../img/edit.png" alt="Edit" style="width: 20px; height: auto;">
                                                        </a>
                                                    </td>
                                                    <td><?php echo $game->idJuegocurso; ?></td>
                                                    <td><?php echo $game->titulo; ?></td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="large-6 columns">
                                                                <a target="_blank" href="../../Repo/Games/<?php echo $game->path; ?>">
                                                                    <img src="../../img/preview.png" alt="View" style="width: 20px; height: auto;">
                                                                </a>
                                                            </div>
                                                            <div class="large-6 columns">
                                                                <a href="../../Controllers/Edit/JuegosCurso.php?id=<?php echo $game->idJuegoCurso; ?>">
                                                                    <img src="../../img/delete.png" alt="Delete" style="width: 20px; height: auto;">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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

<section class="show-video" style="display: none;">
    <div class="video-wrapper">
        <div class="video-container">
            <div class="row">
                <div style="color: #FFFFFF;" class="large-10 columns"><h4>Preview</h4></div>
                <div class="large-2 columns"><a id="closevideo" class="expanded button" href="#">X</a></div>
            </div>
            <div id="previewvideo" class="flex-video">
            </div>
        </div>
    </div>
</section>

<script src="../../js/vendor/jquery.js"></script>
<script src="../../js/vendor/foundation.min.js"></script>
<script src="../../js/app.js"></script>
<script src="../../js/AtomistAlerts/atomist-alert.js"></script>
<script src="../../js/bower_components/showdown/dist/showdown.min.js"></script>
<script>
    $(document).ready(function(){
        $("#closevideo").click(function(evt){
            evt.preventDefault();
            $("#previewvideo").html("");
            $(".show-video").fadeOut();
        });


    });

    function previewVideo(id){
        var video = $("#video_"+id).val();
        $("#previewvideo").html(video);
        $(".show-video").fadeIn();
    }
</script>

</body>
</html>