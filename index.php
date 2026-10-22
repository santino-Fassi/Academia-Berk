<?php

require_once "includes/helpers.php";
require_once "classes/Vista.php";
require_once "classes/Dragon.php";
require_once "classes/Perfil.php";
require_once "classes/Mision.php";
require_once "classes/Suministro.php";
require_once "classes/Inventario.php";

session_start();

$vista = Vista::validarVista($_GET["vista"] ?? "inicio");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACADEMIA DE JINETES DE BERK - <?= $vista->getTitulo() ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"
        defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Caesar+Dressing&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caesar+Dressing&family=MedievalSharp&display=swap"
        rel="stylesheet">
    <link rel="icon" type="img/favcon" href="img/favicon.ico">
</head>

<body>

    <header class="bg-primary border-bottom border-5 border-warning">
        <h1 class="p-3 text-light d-none">ACADEMIA DE JINETES DE BERK</h1>
        <nav class="navbar navbar-expand-lg py-3 px-md-4" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img class="d-none d-lg-block logo d-inline-block"
                        src="img/logo.webp" alt="Logo de la Academia"><span
                        class=" d-lg-none h1 py-3 text-light">ACADEMIA DE JINETES</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link <?= $vista->getNombre() == 'inicio' ? 'active' : '' ?>"
                                <?= $vista->getNombre() == 'inicio' ? 'aria-current="page"' : '' ?> href="index.php">
                                Inicio
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista->getNombre() == 'compendio' ? 'active' : '' ?>"
                                <?= $vista->getNombre() == 'compendio' ? 'aria-current="page"' : '' ?>
                                href="index.php?vista=compendio">
                                Todos los dragones
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista->getNombre() == 'conoce-tu-companero' ? 'active' : '' ?>"
                                <?= $vista->getNombre() == 'conoce-tu-companero' ? 'aria-current="page"' : '' ?>
                                href="index.php?vista=conoce-tu-companero#conoceTuCompanero">
                                Conoce a tu compañero
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista->getNombre() == 'mapa' ? 'active' : '' ?>"
                                <?= $vista->getNombre() == 'mapa' ? 'aria-current="page"' : '' ?>
                                href="index.php?vista=mapa">
                                Mapa
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <main class="bg-light container-fluid py-2">

        <?php
        require_once "views/{$vista->getNombre()}.php";
        ?>

    </main>

    <footer class="py-4 mt-4 container-fluid rounded-bottom rounded-4 bg-primary">
        <div class="row">
            <div class="c_autor text-center col-12 col-md-6">
                <img class="mb-3 border-2" src="img/fassi.webp"
                    alt="Fotografía de uno de los autores de esta página web, Santino Fassi">
                <ul class="text-light list-unstyled">
                    <li>Nombre: Santino Fassi</li>
                    <li>Edad: 20 años</li>
                    <li><a class="btn btn-dark" href="mailto:santino.fassi@davinci.edu.ar">Contacto</a></li>
                </ul>
            </div>
            <div class="c_autor text-center col-12 col-md-6 flex-md-row-reverse">
                <img class="mb-3 border-2" src="img/gastager.webp"
                    alt="Fotografía de uno de los autores de esta página web, Camila Gastager">
                <ul class="text-light list-unstyled">
                    <li>Nombre: Camila Gastager</li>
                    <li>Edad: 20 años</li>
                    <li><a class="btn btn-dark" href="mailto:camila.gastager@davinci.edu.ar">Contacto</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>

</html>