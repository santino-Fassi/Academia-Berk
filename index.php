<?php

require_once "includes/helpers.php";
require_once "classes/Vista.php";
require_once "classes/Producto.php";
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
    <title>ACADEMIA DE JINETES DE BERK - <?= $vista->getTitulo()?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"
        defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Caesar+Dressing&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caesar+Dressing&family=MedievalSharp&display=swap" rel="stylesheet">
    <link rel="icon" type="img/favcon" href="img/favicon.ico">
</head>

<body>

    <header class="bg-primary border-bottom border-5 border-warning">
        <h1 class="p-3 text-light d-none">ACADEMIA DE JINETES DE BERK</h1>
        <nav class="navbar navbar-expand-lg py-3 px-md-4" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img class="d-none d-lg-block logo d-inline-block"
                        src="img/logo.webp" alt="Logo de RetroCamp"><span
                        class=" d-lg-none h1 py-3 text-light">ACADEMIA DE JINETES DE BERK</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?vista=compendio">Todos los dragones</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?vista=conoce-tu-companero#conoceTuCompanero">Conoce a tu compañero</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="index.php?vista=mapa">Mapa</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
    </header>

    <main class="bg-light container-fluid py-5">

    <?php
        require_once "views/{$vista->getNombre()}.php";
    ?>

    </main>

    <footer class="bg-primary border-top border-warning border-2 py-2 px-1 mt-4">
        <div class="c_autor text-center">
            <img class="mb-3 border border-2 border-info-subtle" src="img/autor.webp"
                alt="Fotografía del autor de esta página web, Santino Fassi">
            <ul class="text-light">
                <li>Nombres: Santino Fassi y Camila Gastager</li>
                <li>Edades: 20 y 21 años</li>
                <li><a class="btn btn-dark" href="mailto:santino.fassi@davinci.edu.ar">Contacto Santino</a></li>
                <li><a class="btn btn-dark" href="mailto:camila.gastager@davinci.edu.ar">Contacto Camila</a></li>
            </ul>
        </div>
    </footer>


    <!-- <script src="scripts/hoverEffect.js"></script> -->
</body>

</html>