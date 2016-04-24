<?php 
require_once __DIR__."/vendor/autoload.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="css/foundation.min.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

<nav>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="menu-text">Panel de administración</li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="row">
        <div class="large-12 columns">
            <form action="Controllers/LoginController.php" method="post">
                <div class="callout large">
                    <div class="row">
                        <div class="large-12 columns">
                            <h1>Ingresar</h1>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="large-12 columns">
                            <label for="">
                                Usuario
                                <input type="text" name="correo" id="correo">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label for="">
                                Contraseña
                                <input type="password" name="passwd" id="passwd">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <button type="submit" class="expanded button">Ingresar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/foundation.min.js"></script>
<script src="js/app.js"></script>

</body>
</html>