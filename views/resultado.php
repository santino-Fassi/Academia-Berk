<?php

$datos = $_POST;

$perfil = Perfil::crearPerfil($datos);
$dragon = $perfil->calcularAfinidad();

$_SESSION["nombre"] = $perfil->getNombre();
$_SESSION["dragon"] = $dragon->getId();

?>


<section class="mt-5 mb-5 p-4 p-md-5 bg-light shadow rounded" id="resultadoCompañero">

    <div class="text-center mb-5">

        <h2 class="text-primary mb-4 text-shadow-titles">
            Tu dragón ideal es
        </h2>
        
        <div class="card card-dragon mx-auto">
            <img src="img/dragones/<?=$dragon->getIlustracion()["img"]?>" alt="<?=$dragon->getIlustracion()["alt"]?>" class="card-img-top">
            <div class="card-body">
                <h3 class="card-title"><?=$dragon->getNombre()?></h3>
                <p class="h4"><span class="fw-bold">Clase: </span> <?=$dragon->getClase()?></p>
                <div class="card-header h5">Resumen</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span class="fw-bold">Peso: </span><?=$dragon->getPeso()?> Kg</li>
                    <li class="list-group-item"><span class="fw-bold">Tamaño: </span><?=$dragon->getTamanio()["tipo"]?> (<?=$dragon->getTamanio()["ancho"]?>m x <?=$dragon->getTamanio()["alto"]?>m)</li>
                    <li class="list-group-item"><span class="fw-bold">Curiosidad: </span>¿Sabías que los <?=$dragon->getNombre()?> tienen <?=strtolower($dragon->getCaracteristicas()[array_rand($dragon->getCaracteristicas())])?>?</li>
                </ul>
                <div class="card-footer">
                    <a href="index.php?vista=compendio&dragon_id=1" class="btn btn-purple" target="_blank">Saber más</a>
                </div>
            </div>
        </div>


    </div>

    <a href="index.php?vista=conoceTuCompanero" class="btn btn-secondary">Rehacer formulario</a>
    <a href="index.php?vista=misiones" class="btn btn-primary">¿Estás listo para hacer una misión con tu
        <?= $dragon->getNombre() ?>?</a>



</section>