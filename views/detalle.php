<?php 

$id = $_GET["id"] ?? 1;

$producto = Producto::producto_x_id($id) ?? Producto::producto_x_id(1);

?>

<section class="detalle-info">
    <div>
        <img class="img-fluid d-block mx-auto" src="img/productos/<?= $producto->getImagen() ?>"
            alt="<?= $producto->getAlt() ?>">
    </div>
    <div class="text-center">
        <h2 class=""><?= $producto->getNombre() ?></h2>
        <div class="d-flex justify-content-center">
            <img class="m-1 es-llena" src="img/estrella-blanca.webp" alt="">
            <img class="m-1 es-llena" src="img/estrella-blanca.webp" alt="">
            <img class="m-1 es-llena" src="img/estrella-blanca.webp" alt="">
            <img class="m-1 es-llena" src="img/estrella-blanca.webp" alt="">
            <img class="m-1" src="img/estrella-blanca.webp" alt="">
        </div>
        <p class="precio h3 mb-3">$<?= number_format($producto->getPrecio(), 0, ",", ".") ?></p>
        <a class="text-decoration-none h6 text-primary" href="#">Medios de pago</a>
    </div>
    <div id="info-compra">
        <p class="h5 text-success">Llega gratis entre el 8/jul y el 10/jul</p>
        <p><span class="fw-bold">Stock Disponible:</span> 10 unidades disponibles</p>
        <a href="#" class="btn btn-purple btn-lg d-block mx-auto mt-auto">Comprar</a>
    </div>

    <div id="detalle-descripcion" class="descripcion">
        <h3 class="text-primary mb-4 text-shadow-titles border-bottom border-warning pb-1">Descripción</h3>
        <p>Se vende una consola PS2 totalmente funcional. <strong>Tu compra incluirá la consola PS2, un mando con cable
            de la marca Sony, todos los cables AV y AC que necesitas para jugar, ¡y un adaptador de red para
            jugar con tus amigos!</strong> - La consola Playstation 2 te permite jugar a juegos originales de PS1, así
            como a la enorme selección de juegos de PS2 - Incluye: consola Playstation 2, 1 mando Dual Shock 2,
            cable AC y cable AV - Color: negro - La PlayStation 2 está equipada con un procesador Emotion Engine
            de 128 bits que permite una jugabilidad ultrarrápida y una potencia gráfica impresionante. <em>Este
            producto es de grado A reacondicionado, lo que significa que está en excelentes condiciones.</em> El
            producto se ha restaurado para que funcione correctamente y parece casi nuevo, con mínimos signos de
            uso.</p>
    </div>

    <div id="detalle-caracteristicas" class="descripcion">
        <h3 class="text-primary mb-4 text-shadow-titles border-bottom border-warning pb-1">Características del
            producto</h3>
        <ul>
            <li><span class="fw-bold">Marca: </span>Sony</li>
            <li><span class="fw-bold">Modelo: </span>PlayStation 2</li>
            <li><span class="fw-bold">Color: </span>Negro</li>
            <li><span class="fw-bold">Peso: </span>2,51 kg</li>
            <li><span class="fw-bold">Altura x Ancho: </span>16 cm x 23 cm</li>
        </ul>
    </div>

    <div id="detalle-galeria" class="contenedor-galeria px-lg-4">
        <h3 class="text-primary mb-4 text-shadow-titles border-bottom border-warning pb-1">Galería del Producto
        </h3>
        <div class="grid-galeria">
            <img class="img-fluid d-block shadow img-destacada" src="img/detalle/muestra-play2-1.webp"
                alt="Fotografía de la PlayStation 2 con su mando, en un ángulo de 30 grados.">
            <img class="img-fluid d-block shadow" src="img/productos/playstation_2.webp"
                alt="Fotografia de la PlayStation 2 de frente.">
            <img class="img-fluid d-block shadow" src="img/detalle/muestra-play2-2.webp"
                alt="Fotografía desde arriba de la PlayStation 2, con sus cables de conexión y mando.">
        </div>
    </div>
</section>